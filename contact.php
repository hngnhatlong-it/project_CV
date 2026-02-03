<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
    <style>
        /* CSS nội tuyến */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #c8e7d8;
            color: #4e5e72;
            text-align: center;
            font-family: monospace;
            overflow: hidden;
            position: relative; /* Thêm để định vị .result-message */
        }

        h1, p {
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 2rem;
            font-family: 'Dancing Script', cursive;
        }

        small {
            display: block;
            padding: 1rem 0;
            font-size: 0.8rem;
            transition: opacity 0.33s;
        }

        textarea, input, button {
            line-height: 1.5rem;
            border: 0;
            outline: none;
            font-family: inherit;
            appearance: none;
        }

        textarea, input {
            color: #4e5e72;
            background-color: transparent;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='24'><rect fill='rgb(229, 225, 187)' x='0' y='23' width='10' height='1'/></svg>");
        }

        textarea {
            width: 100%;
            height: 8rem;
            resize: none;
        }

        input {
            width: 50%;
            margin-bottom: 1rem;
        }

        input[type="text"]:invalid,
        input[type="email"]:invalid {
            box-shadow: none;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='24'><rect fill='rgba(240, 132, 114, 0.5)' x='0' y='23' width='10' height='1'/></svg>");
        }

        button {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            background-color: rgba(78, 94, 114, 0.9);
            color: white;
            font-size: 1rem;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        button:hover,
        button:focus {
            outline: none;
            background-color: rgba(78, 94, 114, 1);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='24'><rect fill='rgba(78, 94, 114, 0.3)' x='0' y='23' width='10' height='1'/></svg>");
            outline: none;
        }

        .wrapper {
            width: 35rem;
            background-color: white;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .letter {
            position: relative;
            width: 100%;
            perspective: 60rem;
        }

        .side {
            height: 12rem;
            background-color: #fcfcf8;
            outline: 1px solid transparent;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: inset 0 0.75rem 2rem rgba(229, 225, 187, 0.5);
            transition: transform 0.66s ease-in;
        }

        .side:nth-of-type(2) {
            text-align: right;
            box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.05), inset 0 -0.57rem 2rem rgba(229, 225, 187, 0.5);
        }

        .envelope {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 0;
            width: 10rem;
            height: 6rem;
            border-radius: 0 0 1rem 1rem;
            overflow: hidden;
            opacity: 0;
            z-index: 9999;
        }

        .envelope::before,
        .envelope::after {
            position: absolute;
            display: block;
            width: 12rem;
            height: 6rem;
            background-color: #e9dc9d;
            transform: rotate(30deg);
            transform-origin: 0 0;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
            content: '';
        }

        .envelope::after {
            right: 0;
            transform: rotate(-30deg);
            transform-origin: 100% 0;
        }

        .envelope.back {
            top: -4rem;
            width: 10rem;
            height: 10rem;
            overflow: hidden;
            opacity: 0;
            transform: translateY(-6rem);
            z-index: -9998;
        }

        .envelope.back::before {
            display: block;
            width: 10rem;
            height: 10rem;
            background-color: #e9dc9d;
            border-radius: 1rem;
            content: '';
            transform: scaleY(0.6) rotate(45deg);
        }

        .result-message {
            opacity: 0;
            transition: all 0.3s 2s;
            transform: translateY(9rem);
            z-index: 10000; /* Tăng z-index để đảm bảo nó nằm trên cùng */
            position: absolute; /* Định vị tuyệt đối để dễ dàng kiểm soát vị trí */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) translateY(9rem);
            font-size: 1.2rem;
            color: #4e5e72;
            background-color: rgba(255, 255, 255, 0.9); /* Thêm nền để nổi bật */
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
            pointer-events: none; /* Không ảnh hưởng đến các tương tác khác */
        }

        .sent .letter {
            animation: scaleLetter 1s forwards ease-in;
        }

        .sent .side:nth-of-type(1) {
            transform-origin: 0 100%;
            animation: closeLetter 0.66s forwards ease-in;
        }

        .sent .side:nth-of-type(1) h1,
        .sent .side:nth-of-type(1) textarea {
            animation: fadeOutText 0.66s forwards linear;
        }

        .sent button {
            background-color: rgba(78, 94, 114, 0.2);
            cursor: not-allowed;
        }

        .sent .envelope {
            animation: fadeInEnvelope 0.5s 1.33s forwards ease-out;
        }

        .sent .result-message {
            opacity: 1;
            transform: translate(-50%, -50%) translateY(0);
        }

        .sent small {
            opacity: 0;
        }

        .centered {
            position: relative;
        }

        @keyframes closeLetter {
           50% {transform: rotateX(-90deg);}
           100% {transform: rotateX(-180deg);}
        }

        @keyframes fadeOutText {
           49% {opacity: 1;}
           50% {opacity: 0;}
           100% {opacity: 0;}
        }

        @keyframes fadeInEnvelope {
          0% {opacity: 0; transform: translateY(8rem);}
          100% {opacity: 1; transform: translateY(4.5rem);}
        }

        @keyframes scaleLetter {
          66% {transform: translateY(-8rem) scale(0.5, 0.5);}
          75% {transform: translateY(-8rem) scale(0.5, 0.5);}
          90% {transform: translateY(-8rem) scale(0.3, 0.5);}
          97% {transform: translateY(-8rem) scale(0.33, 0.5);}
          100%{transform: translateY(-8rem) scale(0.3, 0.5);}
        }
    </style>
</head>
<body>
<a href="index.php" style="text-decoration: none; color: #007BFF; font-size: 17px; border: 2px solid transparent; border-radius: 5px; position: fixed 15px 30px" 
        onmouseover="this.style.color='white'; this.style.backgroundColor='#007BFF'; this.style.borderColor='#0056b3'" onmouseout="this.style.color='#007BFF'; this.style.backgroundColor='transparent'; 
        this.style.borderColor='transparent'">Quay lại</a>
    <div class="wrapper centered">
      <article class="letter">
        <div class="side">
          <h1>Liên Hệ Với Chúng Tôi</h1>
          <p>
            <textarea placeholder="Lời nhắn của bạn"></textarea>
          </p>
        </div>
        <div class="side">
          <p>
            <input type="text" placeholder="Tên của bạn" required>
          </p>
          <p>
            <input type="email" placeholder="Email của bạn" required>
          </p>
          <p>
            <button id="sendLetter">Gửi</button>
          </p>
        </div>
      </article>
      <div class="envelope front"></div>
      <div class="envelope back"></div>
      <p class="result-message centered">Cảm ơn bạn đã để lại lời nhắn, chúng tôi sẽ liên hệ với bạn sớm nhất.</p>
    </div> 
    <div class="wrapper centered">
        <article class="letter">
            <div class="side info">
            <h3>Fast Food Store chúng tôi mong sẽ đem đến cho bạn một trải nghiệm ẩm thực tuyệt vời nhất tại đây.</h3>
            <span>Hãy liên hệ với chúng tôi nếu bạn cần. Xin cảm ơn!</span>
            </div>
    <script>
        function addClass() {
            document.body.classList.add("sent");
        }
        document.getElementById("sendLetter").addEventListener("click", function(event) {
            event.preventDefault();           
            // Kiểm tra tính hợp lệ của các trường
            const name = document.querySelector('input[type="text"]');
            const email = document.querySelector('input[type="email"]');
            const message = document.querySelector('textarea');

            if (name.checkValidity() && email.checkValidity() && message.value.trim() !== "") {
                addClass();
            } else {
                alert("Vui lòng điền đầy đủ thông tin và đảm bảo các trường hợp lệ.");
            }
        });
    </script>
</body>
</html>
