const canvas = document.querySelector('canvas')
const ctx = canvas.getContext('2d')

ctx.fillStyle = 'green'
ctx.strokeStyle = 'red'

const position = {
    x: 0,
    y:0
}

function draw() {
    ctx.beginPath()
    ctx.fillStyle = 'green'
    ctx.arc(position.x, position.y, 30, 0, 2 * Math.PI)
    ctx.fill()
    ctx.stroke()
}

addEventListener('mousemove', (e) => {
    // clear canvas
    ctx.fillStyle = 'white'
    ctx.fillRect(0, 0, canvas.width, canvas.height)

    if (e.clientX > 0 && e.clientX < canvas.width) {
        position.x = e.clientX
    }

    if (e.clientY > 0 && e.clientY < canvas.height) {
        position.y = e.clientY
    }

    draw()
})