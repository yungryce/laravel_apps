// Additional scripts from your previous code

const roles = ['Software Engineer', 'Backend Engineer', 'Fullstack Developer', 'Shell Crawler'];
let index = 1;

// Set initial role
document.getElementById('roles').innerHTML = `<p>${roles[0]}</p>`;

setInterval(() => {
    const rolesElement = document.getElementById('roles');
    rolesElement.innerHTML = `<p>${roles[index]}</p>`;
    index = (index + 1) % roles.length;
}, 5000); // Change role every 2 seconds

const revealElements = document.querySelectorAll('.reveal');

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
        } else {
            entry.target.classList.remove('revealed');
        }
    });
}, { threshold: 0.5 });

revealElements.forEach(element => {
    observer.observe(element);
});
