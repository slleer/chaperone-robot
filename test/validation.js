
document.getElementById('name').addEventListener('input', testName);


function testName(e) {
  document.getElementById('other').textContent = e.target.value;
}
