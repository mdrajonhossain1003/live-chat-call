import { initializeApp } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js";
import { getDatabase, ref, push, onChildAdded } from "https://www.gstatic.com/firebasejs/9.23.0/firebase-database.js";

/* 🔥 Firebase Config */
const firebaseConfig = {
  apiKey: "AIzaSyClGMId82oToTT4FZanAXnnHb-LgrnOdxk",
  authDomain: "livechatcall-6b157.firebaseapp.com",
  projectId: "livechatcall-6b157",
  databaseURL: "https://livechatcall-6b157-default-rtdb.firebaseio.com",
  messagingSenderId: "326836036330",
  appId: "1:326836036330:web:8c529e15fac4015d8bad93"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

/* 💬 LIVE CHAT */
window.sendMessage = function () {
  const user = document.getElementById("username").value || "Guest";
  const msg  = document.getElementById("message").value;

  if (!msg) return;

  push(ref(db, "messages"), {
    user: user,
    text: msg,
    time: Date.now()
  });

  document.getElementById("message").value = "";
};

onChildAdded(ref(db, "messages"), (data) => {
  const chat = document.getElementById("chat");
  chat.innerHTML += `<p><b>${data.val().user}:</b> ${data.val().text}</p>`;
});

/* 🎥 VIDEO CALL (WebRTC) */
let localStream;
let peer = new RTCPeerConnection({
  iceServers: [{ urls: "stun:stun.l.google.com:19302" }]
});

window.startCall = async function () {
  localStream = await navigator.mediaDevices.getUserMedia({ video:true, audio:true });
  document.getElementById("localVideo").srcObject = localStream;

  localStream.getTracks().forEach(track => peer.addTrack(track, localStream));

  peer.ontrack = e => {
    document.getElementById("remoteVideo").srcObject = e.streams[0];
  };
};