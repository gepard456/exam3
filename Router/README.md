<h1>Компонент Router</h1>


<h2>Ход мыслей при разработке компонента</h2>

<p>Согласно принципу единой ответственности данный класс должен отвечать только за выполение маршрутизации запросов пользователей.</p>

<p>При использовании данного класса отсутствует необходимость создания его экземпляров, поэтому запрещено создание экземпляра данного класса и его клонирование. Все методы сделаны статическими.</p>

<p>Метод execute принадлежит к интерфейсу данного класса, доступен пользователям.</p>

<h2>Документация</h2>


<h3>execute</h3>

<p>Метод выполняет маршрутизацию запросов пользователей:</p>

<pre>
Router::execute(
    [                                                   <span class="pl-c">// массив маршрутизации</span>
        "/"         =>  "controllers/homepage.php",
        "/about"    =>  "controllers/about.php"
    ],
    "controllers/404.php"                             <span class="pl-c">// путь к файлу с ошибкой 404</span>
);
</pre>