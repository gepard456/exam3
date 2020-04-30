<h1>Компонент QueryBuilder</h1>
<p>Класс QueryBuilder реализован по шаблону Singleton. Для построения запросов можно использовать метод Chaining.</p>

<h2>Документация</h2>

<h3>Построение запросов</h3>
<p>Сначала необходимо создать экземпляр класса QueryBuilder:</p>

<pre>$qb = QueryBuilder::<b>getInstance</b>(PDO $pdo);</pre>


<h3>getAll</h3>
<p>Метод позволяет получить все записи указанной таблицы.</p>

<pre>
$qb->getAll(
    'table'         <span class="pl-c">// имя таблицы</span>
);
</pre>