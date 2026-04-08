<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Buttons</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f4f4f9;
    }

    .button-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px; /* Jarak antar tombol */
      max-width: 100%;
    }

    .button-container button {
      padding: 10px 20px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .button-container button:hover {
      background-color: #0056b3;
    }

    .add-button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .add-button:hover {
      background-color: #1c7c31;
    }
  </style>
</head>
<body>
  <div class="button-container" id="buttonContainer">
    <button>Button 1</button>
    <button>Button 2</button>
  </div>
  <button class="add-button" id="addButton">Add Button</button>

  <script>
    const buttonContainer = document.getElementById('buttonContainer');
    const addButton = document.getElementById('addButton');
    let buttonCount = 2;

    addButton.addEventListener('click', () => {
      buttonCount++;
      const newButton = document.createElement('button');
      newButton.textContent = `Button ${buttonCount}`;
      buttonContainer.appendChild(newButton);
    });
  </script>
</body>
</html>
