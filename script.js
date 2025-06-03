function validateForm() {
    let key = document.getElementById('key').value;
    if (!/^[a-zA-Z]+$/.test(key)) {
        alert("Klucz może zawierać tylko litery A-Z (bez cyfr i znaków specjalnych).");
        return false;
    }
    return true;
}

function checkKeyStrength() {
    const key = document.getElementById('key').value;
    const output = document.getElementById('keyStrength');

    if (key.length < 4) {
        output.textContent = "Siła klucza: słaba 🔴";
        output.style.color = "red";
    } else if (key.length < 8) {
        output.textContent = "Siła klucza: średnia 🟡";
        output.style.color = "orange";
    } else {
        output.textContent = "Siła klucza: dobra 🟢";
        output.style.color = "green";
    }
}
