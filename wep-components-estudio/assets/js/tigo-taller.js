import {LitElement, html} from 'lit-element';
import {defineCustomElements as initSkeleton} from 'skeleton-webcomponent-loader';
import {apiDataProvider} from './services/ApiDataProvider';

export class TigoTaller extends LitElement {

    static get properties() {
        return {
            url: {type: String},
            data: {attribute: false, type: Object},
            loading: {attribute: false}
        };
    }

    constructor() {
        super();
        initSkeleton();

        this.url = '/api';
        this.data = {email: 'juan@dev.com'};
        this.loading = true;

        this.service = new apiDataProvider();

        const cardTemplate = document.createElement('template');

        cardTemplate.innerHTML = `
              <style>
                    @import url("https://atomic.tigocloud.net/sandbox/css/main-v1.1.0.min.css");
              </style>`;

        this.attachShadow({mode: 'open'});
        this.shadowRoot.appendChild(cardTemplate.content.cloneNode(true));
    }

    async connectedCallback() {
        super.connectedCallback();

        await this.getDataUser();
    }


    async getDataUser() {
        setTimeout(async () => {
            let userPromise = await this.service.getUser(this.url);
            this.loading = false;
            this.data = userPromise;
        }, 2000);
    }


    render() {

        if (this.loading) {
            return html`
                <nb-skeleton></nb-skeleton>
            `;
        }

        return html`
            <div class="ml-general-interest">
                ${this.data.map((user) =>
                        html`
                            <div class="at-containershadow-primary">
                                <div class="content-img">
                                    <img width="923" src="${user.picture.thumbnail}" alt="Landscape"
                                         class="at-landscape-image">
                                </div>
                                <div class="content-info">
                                    <h5 class="at-font-h5">${user.name.first} ${user.name.last}</h5>
                                    <p class="at-font-p">${user.location.timezone.description}</p>
                                    <div class="content-button">
                                        <a href="https://www.tigo.com.co/" class="at-button-tertiary">Ir al
                                            centro de ayuda</a>
                                    </div>
                                </div>
                            </div>
                        `
                )}
            </div>

        `;

    }


}

customElements.define('tigo-taller', TigoTaller);