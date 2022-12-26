import { LitElement, html } from 'lit-element';

export class HolaMundo extends LitElement {

   //LIT ELEMENT
    render() {
        return html`<p>Hola Mundo<p/>
        `;
    }
}
customElements.define('hola-mundo', HolaMundo);