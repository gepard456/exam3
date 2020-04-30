<h1>Компонент QueryBuilder</h1>
<p>Класс QueryBuilder реализован по шаблону Singleton. Для построения запросов можно использовать метод Chaining.</p>

<h2>Документация</h2>

<h3>Построение запросов</h3>
<p>Сначала необходимо создать экземпляр класса QueryBuilder:</p>

<pre>$qb = QueryBuilder::<b>getInstance</b>(PDO $pdo);</pre>


<h3>getAll</h3>
<p>Метод позволяет получить все записи из указанной таблицы.</p>

<pre>
$qb->getAll( 'table' ); <span class="pl-c">// имя таблицы</span>
</pre>


<h3>get</h3>
<p>Метод позволяет получить записи из указанной таблицы, которые соответствуют условию.</p>

<pre>
$qb->get(
    'table',        <span class="pl-c">// имя таблицы</span>
    
    [               <span class="pl-c">// условие</span>
        'field',        <span class="pl-c">// имя поля</span>
        '=',            <span class="pl-c">// '=', '>', '<', '>=', '<=' необходимая условность</span>
        'value'         <span class="pl-c">// значение</span>
    ]
);
</pre>
