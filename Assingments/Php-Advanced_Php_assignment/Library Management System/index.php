<?php
/* ===== Interface ===== */
interface Borrowable {
    public function borrow(Book $book);
}

/* ===== Abstract Class ===== */
abstract class Person {
    protected $name;
    public function __construct($name) {
        $this->name = $name;
    }
    abstract public function role();
}

/* ===== Book Class ===== */
class Book {
    private $title;
    private $available = true;

    public function __construct($title) {
        $this->title = $title;
    }

    public function borrow() {
        if ($this->available) {
            $this->available = false;
            return true;
        }
        return false;
    }

    public function isAvailable() {
        return $this->available;
    }

    // Magic method
    public function __toString() {
        return $this->title;
    }
}

/* ===== Member Class ===== */
class Member extends Person implements Borrowable {

    public function role() {
        return "Member";
    }

    public function borrow(Book $book) {
        if ($book->borrow()) {
            echo $this->name . " borrowed " . $book . "<br>";
        } else {
            echo $book . " not available<br>";
        }
    }
}

/* ===== Library Class ===== */
class Library {
    private $books = [];

    public function add(Book $book) {
        $this->books[] = $book;
    }

    // Show all book names
    public function showAllBooks() {
        echo "<b>All Books:</b><br>";
        foreach ($this->books as $book) {
            echo $book . "<br>";
        }
    }

   
}

/* ===== MAIN ===== */
$library = new Library();

$b1 = new Book("PHP");
$b2 = new Book("Java");
$b3 = new Book("Python");
$b4 = new Book("html");


$library->add($b1);
$library->add($b2);
$library->add($b3);
$library->add($b4);


$user = new Member("john");
echo "<h2>library management system</h2>";

echo "Role: " . $user->role() . "<br><br>";

// Show all books
$library->showAllBooks();
echo "<br>";

// Borrow a book
$user->borrow($b1);


