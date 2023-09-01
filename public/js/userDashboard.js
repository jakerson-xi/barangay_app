function clock() {
    const timeDisplay = document.getElementById("clock");
    const dateString = new Date().toLocaleString();
    const formattedString = dateString.replace(", ", " - ");
    timeDisplay.textContent = formattedString;
  }

  setInterval(clock, 1000);