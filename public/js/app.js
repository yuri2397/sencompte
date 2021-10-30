var id = -1;
let htmlCollection = document.getElementsByClassName('delete-btn');
let btns = [].slice.call(htmlCollection);
btns.forEach(btn => {
    btn.onclick = function() {
        id = btn.getAttribute("data-del-account");
    }
});

function submitDeleteForm() {
    let form = document.getElementById('delete-form');
    form.action = "/admin/delete-account/" + id;
    form.submit();
}