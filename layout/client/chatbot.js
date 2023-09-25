let value = 0;
document.getElementById("chatbot-close").addEventListener("click", () => {
  value = 0;
  if (value === 0) {
    document.getElementById("chatbot").style.display = "none";
    document.getElementById("chatbot-icon").style.display = "block";
  }
});
document.getElementById("chatbot-icon").addEventListener("click", () => {
  value = 1;
  console.log(value);
  if (value === 1) {
    document.getElementById("chatbot").style.display = "block";
    document.getElementById("chatbot-icon").style.display = "none";
  }
});
