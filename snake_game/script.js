window.onload = function()  //fuction that launch immediately the javascript code within it after the loading of the html page
{
        // global variable 
    var canvasWidth = 900;
    var canvasHeight = 500;
    blockSize = 15;
    var ctx;
    var delay = 150;
    var snakee;
    var applee;
    var widthInBlock = canvasWidth/blockSize;   //limit of the canvas for game over 
    var heightInBlock = canvasHeight/blockSize;
    var score;
    var audio = new Audio('Tom_and_Jerry.m4a');
    var audio1 = new Audio('piano.mp3');

    init();     // main function

    function init()
    {
        var canvas = document.createElement('canvas');      //javascript inner function of creating an canvas
        canvas.width = canvasWidth;
        canvas.height = canvasHeight;
        canvas.style.border = "30px solid gray";
        canvas.style.margin = "auto auto";
        canvas.style.display = "block";
        canvas.style.backgroundColor = "#ddd";
        document.body.appendChild(canvas);
        ctx = canvas.getContext('2d');              //inner javascript method for drawing in context 2d or 3d
        snakee = new Snake([[6,4], [5,4], [4,4]], "right");     //creating of snake with constructor of the class snake with a constructor
        applee = new Apple([10,10]);
        score = 0;
        refreshCanvas();
    }

    function refreshCanvas()        //refresh the snake after each sequence of time
    {
        snakee.advance();
        if(snakee.checkCollision())
            {
                // GAME OVER
                gameOver();
            }
        else
        {
            if(snakee.isEatingApple(applee))
                {
                    // the snake ate the apple
                    score ++;
                    snakee.ateApple = true;
                    do
                    {
                        applee.setNewPosition();
                    }
                    while(applee.isOnSnake(snakee))
                }
            ctx.clearRect(0,0,canvasWidth, canvasHeight);
            drawScore();
            snakee.draw();
            applee.draw();
            setTimeout(refreshCanvas,delay);
        }
    }

    function drawBlock(ctx, position)       // draw of the snake in one position
    {
        var x = position[0] * blockSize;
        var y = position[1] * blockSize;
        ctx.fillRect(x ,y , blockSize, blockSize);
    }

    function gameOver()
    {
        audio1.pause();
        audio.play();
        ctx.save();
        ctx.font = "bold 70px sans-serif";
        ctx.fillStyle = "#000";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.strokeStyle = "white"; 
        ctx.lineWidth = 5;
        var centreX = canvasWidth / 2;
        var centrey = canvasHeight / 2;
        ctx.strokeText("Game Over",centreX, centrey - 180);
        ctx.fillText("Game Over", centreX, centrey - 180);
        ctx.font = "bold 40px sans-serif";
        ctx.strokeText("Appuyer sur la touche Espace pour rejouer",centreX, centrey - 120);
        ctx.fillText("Appuyer sur la touche Espace pour rejouer",centreX, centrey - 120)
        ctx.restore();
    }

    function restart()
    {
        snakee = new Snake([[6,4], [5,4], [4,4]], "right");     //creating of snake with constructor of the class snake with a constructor
        applee = new Apple([10,10]);
        score = 0;
        delay = 150;
        audio.pause();
        audio1.play();
        refreshCanvas();
    }
    function drawScore()
    {
        ctx.save();
        ctx.font = "bold 200px sans-serif";
        ctx.fillStyle = "gray";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        var centreX = canvasWidth / 2;
        var centrey = canvasHeight / 2;
        ctx.fillText(score.toString(), centreX, centrey);
        ctx.restore();
    }

    function Snake(body, direction)             //Class snake
    {
        //inner variables
        this.body = body;
        this.direction = direction;
        this.ateApple = false;
        
        //methods
        this.draw = function()
        {
            ctx.save();
            ctx.fillStyle = "#ff0000";
            for(var i = 0; i < this.body.length; i++)
                {
                    drawBlock(ctx, this.body[i]);
                }
            ctx.restore();
        };
        this.advance = function()
        {
            var nextPosition = this.body[0].slice();
            switch(this.direction)
            {
                case "left":
                    nextPosition[0] -= 1;
                    break;
                case "right":
                    nextPosition[0] += 1;
                    break;
                case "down":
                    nextPosition[1] += 1;
                    break;
                case "up":
                    nextPosition[1] -= 1;
                    break;
                default:
                    throw("Invalid Direction");
            }
            this.body.unshift(nextPosition);       //advance in the nexposition
            if(!this.ateApple)
                this.body.pop();                  //clear the last section of the snake after advancing
            else
            {
                this.ateApple = false;
                delay -= 5;
            }
        };

        this.setDirection = function(newDirection)      //show the possible direction depending of the previous
        {
            var allowedDirections;
            switch(this.direction)
            {
                case "left":
                case "right":
                    allowedDirections = ["up", "down"];
                    break;
                case "down":
                case "up":
                    allowedDirections = ["left", "right"];
                    break;
                default:
                    throw("Invalid Direction");
            }
            if(allowedDirections.indexOf(newDirection) > -1)
            {
                this.direction = newDirection;
            }

        };
        this.checkCollision = function()        //game over checking function
        {

            var wallCollision = false;
            var snakeCollison = false;
            var head = this.body[0];
            var rest = this.body.slice(1);
            var snakeX = head[0];
            var snakeY = head[1];
            var minX = 0;
            var minY = 0;
            var maxX = widthInBlock -1;
            var maxY = heightInBlock - 1;
            var isNotBetweenHorizontalWalls = snakeX < minX || snakeX > maxX;
            var isNotBetweenVerticalWalls = snakeY < minY || snakeY > maxY;
            if(isNotBetweenHorizontalWalls||isNotBetweenVerticalWalls)
                {
                    wallCollision = true;
                }
            for(var i = 0; i< rest.length; i++)
                {
                    if(snakeX === rest[i][0] && snakeY === rest[i][1])
                        {
                            snakeCollison = true;
                        }
                }

                return wallCollision || snakeCollison;

        };
        this.isEatingApple = function(appleToEat)
        {
            var head = this.body[0];
            if(head[0] === appleToEat.position[0] && head[1] === appleToEat.position[1])
                    return true;
                else
                    return false;

        };
    }

    function Apple(position)        //food of the snake
    {
        this.position = position;
        this.draw = function()
        {
            ctx.save();
            ctx.fillStyle = "#33cc33";
            ctx.beginPath();
            var radius = blockSize/2;
            var x = this.position[0]*blockSize + radius;
            var y = this.position[1]*blockSize + radius;
            ctx.arc(x,y, radius, 0, Math.PI*2, true); 
            ctx.fill();
            ctx.restore();
        };
        this.setNewPosition = function()    //drawing of new apple after the eating of the last
        {
            var newX = Math.round(Math.random()*(widthInBlock-1));
            var newY = Math.round(Math.random()*(heightInBlock-1));
            this.position = [newX, newY];
        };
        this.isOnSnake = function(snakeToCheck)
        {
            var isOnSnake = false;
            for(var i = 0; i < snakeToCheck.body.length; i++)
                {
                    if(this.position[0] === snakeToCheck.body[i][0] && this.position[1] === snakeToCheck.body[i][1])
                        {
                            isOnSnake = true;
                        }
                }
            return isOnSnake;
        };

    }

    document.onkeydown = function handleKeyDown(e)      //inner function of managment or handling of the keybord with the differents codes of keyboars inputs 
    {
        var key = e.keyCode;
        var newDirection;
        switch(key)
        {
            case 37:
                newDirection = "left";
                break;
            case 38:
                newDirection = "up";
                break;
            case 39:
                newDirection = "right";
                break;
            case 40:
                newDirection = "down";
                break;
            case 32:
                restart();
                return;
            default:
                return;
        }
        snakee.setDirection(newDirection);

    }
    let interval

        interval = setInterval (function (){ requestAnimationFrame (canvas)}, INTERVAL)
        function gamepaused()
            {
                clearInterval(interval);
            }
          
        function gameResume()
            {
                interval = setInterval (function (){
                    requestAnimationFrame (canvas)
                }, INTERVAL)
            }
}