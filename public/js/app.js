var id = -1;
let htmlCollection = document.getElementsByClassName('on-click');
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

function dateRestant(date) {
    var actu = new Date();
    var annee = actu.getFullYear();
    var anni = new Date(date + annee);
    var intervalle = anni.getTime() - actu.getTime();
    intervalle = Math.floor(intervalle / (1000 * 60 * 60 * 24));
    return intervalle;
}

function dayDiff(d1, d2) {
    d1 = d1.getTime() / 86400000;
    d2 = d2.getTime() / 86400000;
    let diff = new Number(d2 - d1).toFixed(0);
    if (diff < 0) {
        return -diff
    }
    return diff;
}

(function() {
    let dates = [].slice.call(document.getElementsByClassName("date_end"));
    dates.forEach(e => {
        e.innerHTML = this.dayDiff(new Date(e.innerHTML), new Date());
    })
})();

function submitUpdateForm() {
    let form = document.getElementById('update-form');
    form.action = "/admin/update-account/" + id;
    form.submit();
}

function onNumberMonthChanger(input) {
    if (input.value <= 0)
        input.value = 1;
    else if (input.value > 12)
        input.value = 12;
    let amount = document.getElementById("montant_a_payer");
    amount.value = (input.value * 2000) + " FCFA";
}