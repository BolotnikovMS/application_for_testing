const btn = document.querySelectorAll('button');
let table = document.querySelectorAll('#tableHidden');

btn.forEach((itemBtn, i) => {
    itemBtn.addEventListener('click', () => {
        let test = document.querySelectorAll('#tableHidden');
        test[i].classList.toggle('hidden');
    });
});

function temaSubmit() {
    let sel = document.getElementById("tema");
    let val = sel.options[sel.selectedIndex].value;
    document.getElementById('tema_data').value = val;
    document.getElementById('tema_form').submit();
}
