// Fungsi untuk menentukan hasil berdasarkan skor
function getDepressionResult(score) {
  if (score <= 5) {
    return {
      level: "Sehat",
      description: "Kamu berada dalam kondisi mental yang baik. Tetap jaga keseimbangan hidup dan kesehatanmu."
    };
  } else if (score <= 10) {
    return {
      level: "Depresi Ringan",
      description: "Kamu menunjukkan tanda-tanda depresi ringan. Perhatikan keseharianmu dan pertimbangkan berbicara dengan seseorang."
    };
  } else if (score <= 15) {
    return {
      level: "Depresi Sedang",
      description: "Gejala depresi sedang terdeteksi. Penting untuk mencari bantuan profesional."
    };
  } else if (score <= 20) {
    return {
      level: "Depresi Berat",
      description: "Gejala depresi berat terdeteksi. Segera hubungi tenaga medis atau psikolog."
    };
  } else {
    return {
      level: "Depresi Sangat Berat",
      description: "Gejala sangat berat. Intervensi segera dari profesional sangat disarankan."
    };
  }
}

// Simulasi skor dari backend
let score = 13; // nanti bisa diganti dengan skor dinamis

// Tampilkan skor
document.getElementById("score").innerText = score;

const result = getDepressionResult(score);
document.getElementById("result-title").innerText = result.level;
document.getElementById("result-description").innerText = result.description;

// Tampilkan indikator posisi
let positionPercent = (score / 25) * 100;
const indicator = document.getElementById("indicator");
indicator.style.left = `calc(${positionPercent}% - 18px)`;
indicator.innerText = score;

// Navigasi tombol
function repeatTest() {
  window.location.href = "tes.html";
}

function viewDetails() {
  window.location.href = "detail.html?score=" + score;
}

function findExpert() {
  window.location.href = "konsultasi.html";
}
