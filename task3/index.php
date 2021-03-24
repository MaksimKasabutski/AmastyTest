<a href="../index.php"><- Back</a><br>
<h1>Банкомат</h1>
<form id="form">
    <label for="denomination">Номинал в наличии</label>
    <br>
    <input type="text" id="denomination" value="5, 10, 20, 50, 100, 200, 500" required style="width: 200px">
    <br><br>
    <label for="sum">Ваша сумма</label>
    <br>
    <input type="number" id="sum" required>
    <br><br>
    <input type="submit" value="Отправить">
</form>
<div id="response"></div>
<script src='script.js'></script>