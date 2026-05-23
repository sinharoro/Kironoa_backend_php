/*
  ── Send a message to the PHP API ──
  Place this function in your React/Next.js component.
  It calls save_message.php at http://localhost/final-exam/
*/

async function sendMessage(nickname, message) {
  const response = await fetch('http://localhost/final-exam/save_message.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      nickname: nickname,
      message: message,
    }),
  });

  const data = await response.json();

  if (!response.ok) {
    throw new Error(data.error || 'Failed to send message');
  }

  return data; // { success: true, id: 1 }
}

/* ── Example usage inside a React component ──

const handleSubmit = async (e) => {
  e.preventDefault();
  try {
    const result = await sendMessage(nickname, message);
    console.log('Message saved with ID:', result.id);
    setSuccess('Message sent!');
    setNickname('');
    setMessage('');
  } catch (err) {
    setError(err.message);
  }
};

*/
