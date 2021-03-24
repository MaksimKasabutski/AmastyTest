let form = document.getElementById('form')
let response = document.getElementById('response')

form.onsubmit = function(event) {
    event.preventDefault();

    let denomination = document.getElementById('denomination').value
    let sum = document.getElementById('sum').value

    let xhr = new XMLHttpRequest()
    let body = JSON.stringify({
        "denomination": denomination,
        "sum": sum
    })
    xhr.open("POST", "atm.php", true)
    xhr.setRequestHeader('Content-Type', 'application/json')
    xhr.send(body)
   
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let json = JSON.parse(xhr.responseText)
            response.innerHTML = json.message
        }
    }
    
}