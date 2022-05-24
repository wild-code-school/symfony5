/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
console.log('Hello Webpack Encore !')
import studio from './images/studio.png';

let html = `<img src="${studio}" alt="ACME logo">`;
// start the Stimulus application
import './bootstrap';
