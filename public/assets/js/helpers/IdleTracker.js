class IdleTracker {
  constructor(timeoutDuration, actionCallback) {
    this.timeoutDuration = timeoutDuration;
    this.actionCallback = actionCallback;
    this.resetTimer = this.resetTimer.bind(this);
    this.startTimer = this.startTimer.bind(this);
    this.onActivity = this.onActivity.bind(this);
    this.start();
  }

  start() {
    this.startTimer();
    this.startTimerAcrossTabs();
    window.addEventListener('mousemove', this.onActivity);
    window.addEventListener('keypress', this.onActivity);
  }

  resetTimer() {
    clearTimeout(this.timeout);
    this.timeout = setTimeout(() => {
      this.actionCallback();
    }, this.timeoutDuration);
  }

  startTimer() {
    this.resetTimer();
  }

  onActivity() {
    this.resetTimer();
  }

  startTimerAcrossTabs() {
    const lastActiveTime = localStorage.getItem('lastActiveTime');
    const currentTime = Date.now();

    if (lastActiveTime) {
      const idleTime = currentTime - parseInt(lastActiveTime, 10);
      if (idleTime < this.timeoutDuration) {
        this.timeoutDuration -= idleTime;
        this.resetTimer();
      }
    }

    localStorage.setItem('lastActiveTime', currentTime);
    this.tabCheckInterval = setInterval(() => {
      const storedTime = parseInt(localStorage.getItem('lastActiveTime'), 10);
      if (storedTime && currentTime - storedTime > this.timeoutDuration) {
        this.actionCallback();
        clearInterval(this.tabCheckInterval);
      }
    }, 1000);
  }

  stop() {
    clearTimeout(this.timeout);
    clearInterval(this.tabCheckInterval);
    localStorage.removeItem('lastActiveTime');
    window.removeEventListener('mousemove', this.onActivity);
    window.removeEventListener('keypress', this.onActivity);
  }
}

// Example usage:
const idleAction = () => {
  console.log('User is idle for 30 minutes');
  sendLogout() // remove access token cookie or perform other actions
};

const idleTracker = new IdleTracker(30 * 60 * 1000, idleAction);
