function payFine() {
    const btn = document.getElementById('payFineButton');
    btn.classList.remove('btn-primary');
    btn.classList.add('btn-success');
    btn.innerText = "Fine successfully paid";
}