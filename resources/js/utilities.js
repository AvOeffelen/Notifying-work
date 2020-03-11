function template(name) {
    var element = document.querySelector('#template_' + name);
    if (element === null) {
        console.warn(`Template with name ${name} could not be found. Ensure #template_${name} is in the DOM.`);

        return null;
    }

    return element.innerHTML;
}

window.template = template;
