const send_button = document.getElementById('send-logo');
const message_entry = document.getElementById('message');

function sendMessages() {
    
    fetch('/chat/send_message.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id_receiver=${id_receiver}&message=${encodeURIComponent(message_entry.value)}`
    })
    .catch(error => console.error('Erreur AJAX:', error));
    message_entry.value = ""
}

send_button.addEventListener('click', () => sendMessages());
