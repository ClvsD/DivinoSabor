function mask(o, f) {
    v_obj = o;
    v_fun = f;
    setTimeout("execmask()", 1);
}

function execmask() {
    v_obj.value = v_fun(v_obj.value);
}

function maskcpf(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return v;
}

function idcss(el) {
    return document.getElementById("cpf");
}

window.onload = function () {
    idcss("cpf").setAttribute('maxlength', 14);
    idcss("cpf").onkeypress = function () {
        mask(this, maskcpf);
    }
}