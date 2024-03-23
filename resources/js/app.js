import './bootstrap';


// window.Vue = require('vue').default();


window.edit = function () {
    // Select all tags
    var input = document.querySelectorAll('input');
    var select = document.querySelectorAll('select');
    var p = document.querySelectorAll('p');
    var textarea = document.querySelectorAll('textarea');
    var button = document.querySelectorAll('button');


    // Convert NodeList to Array
    input = Array.from(input)
    select = Array.from(select)
    p = Array.from(p);
    textarea = Array.from(textarea)
    button = Array.from(button)

    // Concat all elements
    var elements = input.concat(select, p, textarea, button);

    for (const elem of elements) {
        // Remove hidden if it exists, else add hidden
        elem.classList.toggle('hidden');
    }
}