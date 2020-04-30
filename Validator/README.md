<h1>Компонент Validator</h1>


<h2>Ход мыслей при разработке компонента</h2>

<p>Согласно принципу единой ответственности данный класс должен отвечать только за валидацию данных. То есть, запросы к БД - не входят в его ответственность. Поэтому, соглачно правилам разделения и делегирования для данного класса имеется Dependency Injection - класс QueryBuilder, который необходим для работы данного класса.</p>

<p>Метод addError является вспомогательным при реализации Validator, поэтому доступ к нему ограничен для пользователей. Остальные методы данного класса относятся к его интерфейсу, поэтому доступны пользователю.</p>


<h2>Документация</h2>

<p>Можно использовать метод Chaining (вызов методов цепочкой).</p>

<h3>Инициализация</h3>

<p><a href="https://github.com/gepard456/exam3/tree/master/QueryBuilder">Dependents:</a> 1</p>
<p>Сначала необходимо создать экземпляр класса Validator:</p>

<pre>$validator = new Validator(QueryBuilder $qb);</pre>


<h3>check</h3>

<p>Метод позволяет проверить данные на соответствие правилам. Можно задать следующие правила:</p>

<ul>
    <li><b>required</b> - обязательность заполения (не пустое значение);</li>
    <li><b>min</b> - минимальная длина строки;</li>
    <li><b>max</b> - максимальная длина строки;</li>
    <li><b>matches</b> - проверка на совпадение;</li>
    <li><b>unique</b> - проверка на уникальность;</li>
    <li><b>email</b> - корректность email.</li>
</ul>

<p>Пример валидации данных, пришедших из формы методом POST:</p>

<pre>
$validator
    ->check(
        $_POST,                             <span class="pl-c">// данные, подлежащие валидации</span>
        
        [                                   <span class="pl-c">// правила</span>
            'name' => [                         <span class="pl-c">// имя поля</span>
                'required' => true,                 <span class="pl-c">// обязательно</span>
                'min' => 2,                         <span class="pl-c">// минимальная длина</span>
                'max' => 15,                        <span class="pl-c">// максимальная длина</span>
            ],
            'email' => [                        <span class="pl-c">// имя поля</span>
                'required' => true,                 <span class="pl-c">// обязательно</span>
                'email' => true,                    <span class="pl-c">// проверка корректности email</span>
                'unique' => 'users'                 <span class="pl-c">// проверка на уникальности в таблице users</span>
            ],
            'password' => [                     <span class="pl-c">// имя поля</span>
                'required' => true,                 <span class="pl-c">// обязательно</span>
                'min' => 3                          <span class="pl-c">// минимальная длина</span>
            ],
            'password_again' => [               <span class="pl-c">// имя поля</span>
                'required' => true,                 <span class="pl-c">// обязательно</span>
                'matches' => 'password'             <span class="pl-c">// должно совпадать с полем password</span>
            ],
            'consent' => [                      <span class="pl-c">// имя поля</span>
                'required' => true,                 <span class="pl-c">// обязательно</span>
            ]
        ]
    );
</pre>


<h3>passed</h3>

<p>Метод позволяет узнать пройдена ли валидация:</p>

<pre>
    ->passed();     <span class="pl-c">// true - валидация пройдения, false - валидация не пройдена</span>
</pre>


<h3>errors</h3>

<p>Метод позволяет получить массив ошибок, если они имеются:</p>

<pre>
    ->errors();
</pre>