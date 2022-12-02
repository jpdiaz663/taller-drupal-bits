<?php

namespace Drupal\entrenamiento_bits\Plugin\rest\resource;

use Drupal\Core\KeyValueStore\KeyValueFactoryInterface;
use Drupal\entrenamiento_bits\Entity\ColaboradoresBits;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Represents Prueba records as resources.
 *
 * @RestResource (
 *   id = "entrenamiento_bits_prueba",
 *   label = @Translation("Pruebitaaaaaaa"),
 *   serialization_class = "Drupal\entrenamiento_bits\Entity\ColaboradoresBits",
 *   uri_paths = {
 *     "canonical" = "/api/entrenamiento-bits-prueba/colabs",
 *   }
 * )
 *
 * @DCG
 * The plugin exposes key-value records as REST resources. In order to enable it
 * import the resource configuration into active configuration storage. An
 * example of such configuration can be located in the following file:
 * core/modules/rest/config/optional/rest.resource.entity.node.yml.
 * Alternatively you can enable it through admin interface provider by REST UI
 * module.
 * @see https://www.drupal.org/project/restui
 *
 * @DCG
 * Notice that this plugin does not provide any validation for the data.
 * Consider creating custom normalizer to validate and normalize the incoming
 * data. It can be enabled in the plugin definition as follows.
 * @code
 *   serialization_class = "Drupal\entrenamiento_bits\Entity\ColaboradoresBits",
 * @endcode
 *
 * @DCG
 * For entities, it is recommended to use REST resource plugin provided by
 * Drupal core.
 * @see \Drupal\rest\Plugin\rest\resource\EntityResource
 */
class PruebaResource extends ResourceBase {

  /**
   * The key-value storage.
   *
   * @var \Drupal\Core\KeyValueStore\KeyValueStoreInterface
   */
  protected $storage;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    KeyValueFactoryInterface $keyValueFactory,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger, $keyValueFactory);
    $this->storage = $keyValueFactory->get('entrenamiento_bits_prueba');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('rest'),
      $container->get('keyvalue')
    );
  }

  /**
   * Responds to POST requests and saves the new record.
   *
   * @param array $data
   *   Data to write into the database.
   *
   * @return \Drupal\rest\ModifiedResourceResponse
   *   The HTTP response object.
   */
  public function post(array $data) {
    $data['id'] = $this->getNextId();
    $this->storage->set($data['id'], $data);
    $this->logger->notice('Create new prueba record @id.');
    // Return the newly created record in the response body.
    return new ModifiedResourceResponse($data, 201);
  }

  /**
   * Responds to GET requests.
   *   The ID of the record.
   *
   * @return \Drupal\rest\ResourceResponse
   *   The response containing the record.
   */
  public function get() {

    $colabs = $this->getNormalizeData();
    $attrs['data'] = $colabs;
    $attrs['config']['api_key'] = \Drupal::config('colabs.settings')->get('apy_key');

     return new ResourceResponse($attrs);
  }

  private function getNormalizeData(): \Generator
  {
    $colabs = \Drupal::entityTypeManager()->getListBuilder('colaboradores_bits')->load();

    /** @var ColaboradoresBits $colab */
    foreach ($colabs as $key => $colab) {
      yield $key => [
        'name' => $colab->get('field_nombre')->getValue()[0]['value'],
        'last_name' => $colab->get('field_apellido')->getValue()[0]['value'],
        'age' => $colab->get('field_edad')->getValue()[0]['value'],

      ];
    }

  }

  /**
   * Responds to PATCH requests.
   *
   * @param int $id
   *   The ID of the record.
   * @param array $data
   *   Data to write into the storage.
   *
   * @return \Drupal\rest\ModifiedResourceResponse
   *   The HTTP response object.
   */
  public function patch($id, array $data) {
    if (!$this->storage->has($id)) {
      throw new NotFoundHttpException();
    }
    $stored_data = $this->storage->get($id);
    $data += $stored_data;
    $this->storage->set($id, $data);
    $this->logger->notice('The prueba record @id has been updated.');
    return new ModifiedResourceResponse($data, 200);
  }

  /**
   * Responds to DELETE requests.
   *
   * @param int $id
   *   The ID of the record.
   *
   * @return \Drupal\rest\ModifiedResourceResponse
   *   The HTTP response object.
   */
  public function delete($id) {
    if (!$this->storage->has($id)) {
      throw new NotFoundHttpException();
    }
    $this->storage->delete($id);
    $this->logger->notice('The prueba record @id has been deleted.', ['@id' => $id]);
    // Deleted responses have an empty body.
    return new ModifiedResourceResponse(NULL, 204);
  }

  /**
   * {@inheritdoc}
   */
  protected function getBaseRoute($canonical_path, $method) {
    $route = parent::getBaseRoute($canonical_path, $method);
    // Set ID validation pattern.
    if ($method != 'POST') {
      $route->setRequirement('id', '\d+');
    }
    return $route;
  }

  /**
   * Returns next available ID.
   */
  private function getNextId() {
    $ids = \array_keys($this->storage->getAll());
    return count($ids) > 0 ? max($ids) + 1 : 1;
  }

}
