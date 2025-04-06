document.getElementById('submitFeedback').addEventListener('click', () => {
  const student = document.getElementById('studentSelect').value;
  const feedback = document.getElementById('feedbackInput').value;
  if (!feedback.trim()) return alert("Please enter feedback.");

  let feedbackData = JSON.parse(localStorage.getItem('feedbackData') || '{}');
  if (!feedbackData[student]) feedbackData[student] = [];
  feedbackData[student].push(feedback);
  localStorage.setItem('feedbackData', JSON.stringify(feedbackData));

  document.getElementById('feedbackInput').value = '';
  renderFeedback();
});

function renderFeedback() {
  const student = document.getElementById('studentSelect').value;
  const feedbackData = JSON.parse(localStorage.getItem('feedbackData') || '{}');
  const feedbackList = document.getElementById('feedbackList');
  feedbackList.innerHTML = '';

  if (feedbackData[student]) {
    feedbackData[student].forEach(fb => {
      const li = document.createElement('li');
      li.textContent = fb;
      feedbackList.appendChild(li);
    });
  }
}

document.getElementById('studentSelect').addEventListener('change', renderFeedback);
renderFeedback();
