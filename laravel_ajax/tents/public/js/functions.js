document.addEventListener("DOMContentLoaded", function(){
    var links_list = document.querySelectorAll('#navContent a');
    links_list.forEach( function(a_element) {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = a_element.href;
        if(location == link)
            a_element.classList.add('active');
    });
});