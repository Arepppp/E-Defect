<?php
echo "Error";
?>
<style>
    button.back-button {
        background-color: white;
        color: black;
        padding: 10px 15px;
        border: 1px solid black;
        cursor: pointer;
        position: absolute;
        top: 10px;
        left: 10px;
    }

    button.back-button:hover {
        background-color: #000000;
        color: white;
        border-color: #000000;
    }
</style>

<div class="back-button-container">
    <button class="back-button btn btn-primary" onclick="window.location.href='index'">Back to Main Page</button>
</div>