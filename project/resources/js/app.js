import './bootstrap';
import 'bootstrap';
import $ from 'jquery';

window.$ = $;
window.jQuery = $;

$(function () {
    document.documentElement.classList.add('app-is-ready');
});
