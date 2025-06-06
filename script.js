function validateForm() {
    let key = document.getElementById('key').value;
    let cipher = document.getElementById('cipher').value;

    if (cipher === 'caesar') {
        // Sprawdź, czy klucz to liczba całkowita
        if (!/^-?\d+$/.test(key)) {
            alert("Wybrano szyfr Cezara. Klucz musi być liczbą całkowitą (np. 3 lub -3).");
            return false;
        }
    } else if (cipher === 'vigenere') {
        // Sprawdź, czy klucz to tylko litery
        if (!/^[a-zA-Z]+$/.test(key)) {
            alert("Wybrano szyfr Vigenère. Klucz może zawierać tylko litery (bez cyfr, spacji i znaków specjalnych).");
            return false;
        }
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
