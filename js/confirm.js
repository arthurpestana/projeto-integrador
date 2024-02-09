var elems = document.getElementsByClassName('del_btn');
    var confirmIt = function (e) {
        if (!confirm('Deseja excluir esse livro?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }