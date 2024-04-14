
document.addEventListener('DOMContentLoaded', () => {
    const flowersContainer = document.getElementById('flowers');
    
    for (let i = 0; i < 10; i++) {
        const flower = document.createElement('div');
        flower.classList.add('flower');
        flower.style.left = `${Math.random() * 100}%`;
        flower.style.animationDuration = `${Math.random() * 10 + 10}s`;
        flowersContainer.appendChild(flower);
    }
});
