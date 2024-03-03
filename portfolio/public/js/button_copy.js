function copyToClipboard(id) {
    const codeBlock = document.getElementById(id);
    const codeText = codeBlock.innerText;

    const textarea = document.createElement('textarea');
    textarea.value = codeText;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);

    alert('Code copied to clipboard!');
}