<?php

$loader = new \Twig\Loader\FilesystemLoader('/path/to/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => '/path/to/compilation_cache',
]);

$dbc = pg_connect("host=localhost port=63226 dbname=app user=main password=main");

if (!$dbc) {
    echo "Error.\n";
}
$res = pg_query($dbc, "SELECT title FROM coating");
if (!$res) {
    echo "Ошибка вывода данных";
}

$rows = pg_fetch_assoc($res);

$template = $twig->load('index.html.twig');

echo $template->render(array(
    'id' => $rows['id'],
    'title' => $rows['title'],
));

