<h1>Компонент QueryBuilder</h1>
<p>Класс QueryBuilder реализован по шаблону Singleton. Для построения запросов можно использовать метод Chaining.</p>

<h2>Документация</h2>

<h3>Построение запросов</h3>
<p>Сначала необходимо создать экземпляр класса QueryBuilder:</p>

<div class="highlight highlight-text-html-php"><pre><span class="pl-s1"><span class="pl-c1">$</span>qb</span> = <span class="pl-s1"><span class="pl-c1"></span>QueryBuilder</span>::<span class="pl-en">getInstance</span>(PDO <span class="pl-c1">$</span>pdo);
</pre></div>