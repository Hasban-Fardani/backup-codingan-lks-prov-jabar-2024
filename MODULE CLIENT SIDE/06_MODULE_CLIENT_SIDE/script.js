const canvas = document.querySelector('canvas')
const ctx = canvas.getContext('2d')

const timerElem = document.getElementById('timer')
const scoreElem = document.getElementById('score')
const playerNameElem = document.getElementById('player-name')

const playElem = document.getElementById('welcome')
playElem.onsubmit = (e) => playGame(e)

// Images
const background = new Image()
background.src = './images/background.jpg'
const gun1Image = new Image()
gun1Image.src = './images/gun1.png'
const gun2Image = new Image()
gun2Image.src = './images/gun2.png'
const target1Image = new Image()
target1Image.src = './images/target1.png'
const target2Image = new Image()
target2Image.src = './images/target2.png'
const target3Image = new Image()
target3Image.src = './images/target3.png'
const pointerImage = new Image()
pointerImage.src = './images/pointer.png'
// 

const game = {
    over: false,
    active: false
}

let timer = 1000


const clicked = {
    status: false,
    position: {
        x: 0,
        y: 0
    }
}

const mousePosition = {
    x: 0,
    y: 0
}

let gunSelected = 1
let targetSelected = 1

let hitungMundur = 3

class Pointer {
    constructor() {
        this.image = pointerImage
        this.width = this.image.width
        this.position = {
            x: mousePosition.x - this.width / 2,
            y: mousePosition.y - this.width / 2
        }
        
        // load image jika belum
        if (!this.image) {
            this.image.onload = () => {
                this.width = this.image.width
                ctx.drawImage(this.image, this.position.x, this.position.y)
            }
        }
    }

    animate() {
        this.position = {
            x: mousePosition.x - 23,
            y: mousePosition.y - 23
        }
        ctx.drawImage(pointerImage, this.position.x, this.position.y)
    }
}

class Gun {
    constructor(pointer) {
        this.pointer = pointer
        if (gunSelected == 1) {
            this.image = gun1Image
        } else {
            this.image = gun2Image
        }

        this.position = {
           x: canvas.width/2,
           y: canvas.height/2
        }
        
        // load image jika belum
        if (!this.image) {
            this.image.onload = () => {
                this.width = this.image.width
                ctx.drawImage(this.image, this.position.x, this.position.y)
            }
        }
    }

    animate() {
        this.position.x = this.pointer.position.x + 100
        this.position.y = this.pointer.position.y + 50
        ctx.drawImage(this.image, this.position.x, this.position.y)
    }
}

class Target {
    constructor(position) {
        this.position = position
        this.image = null
        switch (targetSelected) {
            case 1:
                this.image = target1Image
                break;
            case 2:
                this.image = target2Image
                break;
            case 3:
                this.image = target3Image
                break;
        }

        this.width = this.image.width
        this.height = this.image.height
        this.image.onload = () => {
            ctx.drawImage(this.image, position.x, position.y)
            this.width = this.image.width
            this.height = this.image.height
        }
    }

    animate() {
        ctx.drawImage(this.image, this.position.x, this.position.y)
    }
}

// create instances
const pointer = new Pointer()
const gun = new Gun(pointer)
const targets = []

function clearScreen() {
    if (background) {
        ctx.drawImage(background, 0, 0)
    } else {
        background.onload = () => {
            ctx.drawImage(background, 0, 0)
        }
    }
}

function loopGame() {
    if (!game.active || game.over) {
        console.log("matii");
        ctx.font = "60pt Arial"
        ctx.fillText('Game Over', canvas.width/2 - 200, canvas.height/2)
        return
    }

    clearScreen()

    // animate sprites
    targets.forEach((target, targetIndex) => {
        if (clicked.status) {
            
            console.log("klik", clicked.position,'target', target.position, 'size', target.width, target.height)
            if (
                clicked.position.x >= target.position.x && 
                clicked.position.x <= target.position.x + target.width &&
                clicked.position.y  >= target.position.y && 
                clicked.position.y <= target.position.y + target.height
            ) {
                setTimeout(() => {
                    targets.splice(targetIndex, 1)
                    scoreElem.textContent = parseInt(scoreElem.textContent) + 1 
                }, 0)
            }

            clicked.status = false
        }
        target.animate()
    })
    pointer.animate()
    gun.animate()

    requestAnimationFrame(loopGame)
}

function playGame(e) {
    e.preventDefault()
    const nama = document.getElementById('username').value
    const level = document.getElementById('level').value
    switch (level) {
        case 'easy':
            timer = 30
            break;
        case 'medium':
            timer = 20
            break;
        case 'hard':
            timer = 15
            break;
    }
    timerElem.textContent = timer
    document.getElementById('welcome').classList.add('hide');
    document.getElementById('game').classList.remove('hide');
    playerNameElem.textContent = nama

    // memunculkan 3 target diawal
    createTarget()
    createTarget()
    createTarget()    

    clearScreen()
    targets.forEach((target) => target.animate())

    setTimeout(() => {
        console.log("Mulai gameee");
        game.active = true
        loopGame()
    }, 3000);
}

// ketika mouse bergerak
canvas.addEventListener('mousemove', (e) => {
    mousePosition.x = e.clientX
    mousePosition.y = e.clientY
})

canvas.addEventListener('click', (e) => {
    
    clicked.status = true
    clicked.position = {
        x: e.clientX,
        y: e.clientY
    }
})

// spawn target setiap 3 detik 
setInterval(() => {
    createTarget()
}, 3000)

// mengurangi waktu timer setiap 1 detik
setInterval(() => {
    if (game.active && !game.over) {
        if (timer > 0 ) {
            timer -= 1
            timerElem.textContent = timer
        } else {
            game.over = true
            game.active = false
            console.log("waktu habiss");
        }
    }
}, 1000);

function createTarget() {
    targets.push(new Target({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height
    }))
}
