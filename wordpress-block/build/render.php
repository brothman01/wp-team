<p <?php echo get_block_wrapper_attributes(); ?>>
<div id="timer">
	<span id="hours">00</span> :
	<span id="minutes">00</span> :
	<span id="seconds">00</span>
	<div id="buttons">
		<button id="startBtn" onclick="startTimer()">Start</button>
		<button id="stopBtn" onclick="stopTimer()">Stop</button>
</div>
</div>
</p>

<script>
let hours = 0;
let minutes = 0;
let seconds = 0;
let timer;

function startTimer() {
  timer = setInterval(function() {
    seconds++;
    if (seconds == 60) {
      minutes++;
      seconds = 0;
    }
    if (minutes == 60) {
      hours++;
      minutes = 0;
    }
    document.getElementById("hours").innerHTML = pad(hours);
    document.getElementById("minutes").innerHTML = pad(minutes);
    document.getElementById("seconds").innerHTML = pad(seconds);
  }, 1000);
}

function stopTimer() {
  clearInterval(timer);
}

function pad(number) {
  if (number < 10) {
    return "0" + number;
  } else {
    return number;
  }
}

</script>