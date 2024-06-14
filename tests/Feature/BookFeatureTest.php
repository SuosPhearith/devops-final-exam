<?php

use App\Models\Book;
use function PHPUnit\Framework\assertTrue;

test('create book', function () {
    $book = Book::create([
        'title' => 'The Great Gatsby',
        'author' => 'F. Scott Fitzgerald',
        'isbn' => '9780743273565',
    ]);
    assertTrue($book->exists());
});
