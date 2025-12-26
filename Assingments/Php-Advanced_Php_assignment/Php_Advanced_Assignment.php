<?php
/*
     ---------------------------------------------------- Advanced PHP Excercises------------------------------------------------------

     OOPs Concepts:
     
     THEORY EXERCISE:-

      (1) Define Object-Oriented Programming (OOP) and its four main principles: Encapsulation, Inheritance, Polymorphism, and Abstraction. 

           --> Object-Oriented Programming (OOP) is a programming paradigm based on the concept of “objects”, which represent real-world entities.
           --> Each object contains data (attributes/properties) and methods (functions/behaviors) that operate on that data.
           --> OOP helps organize code, making it reusable, modular, scalable, and easier to maintain.

           -->Four Main Principles of OOP:

                1. Encapsulation
                    -->  Wrapping data (variables) and methods (functions) into a single unit (class) and restricting 
                         direct access to some of the object’s components.

                    --> Encapsulation is used To protect data from unauthorized access or modification.

                    Ex.
                     class Student {
                            private $name; // private variable

                            public function setName($name) {
                                $this->name = $name; // method to set value
                            }

                            public function getName() {
                                return $this->name; // method to get value
                            }
                        }

                        $s = new Student();
                        $s->setName("john");
                        echo $s->getName();

                        ➜ Here, the name property is encapsulated and can only be accessed via getter/setter methods.
                
                2. Inheritance

                   --> The process by which one class (child or subclass) can inherit properties and methods from another class (parent or superclass).
                   --> Use To promote code reusability and establish relationships between classes.

                Ex.

                    class Vehicle {
                        public function start() {
                            echo "Vehicle started.<br>";
                        }
                    }

                    class Car extends Vehicle {
                        public function drive() {
                            echo "Car is driving.";
                        }
                    }

                    $car = new Car();
                    $car->start(); // inherited from Vehicle
                    $car->drive();        
     
                
                3. Polymorphism

                   --> The ability of an object to take many forms — meaning the same function name can behave differently in different classes.
                   --> Use To simplify code and allow flexibility in method implementation.

                    Ex.

                    class Shape {
                        public function draw() {
                            echo "Drawing a shape.<br>";
                        }
                    }

                    class Circle extends Shape {
                        public function draw() {
                            echo "Drawing a circle.<br>";
                        }
                    }

                    class Square extends Shape {
                        public function draw() {
                            echo "Drawing a square.<br>";
                        }
                    }

                    $shapes = [new Circle(), new Square()];
                    foreach ($shapes as $shape) {
                        $shape->draw(); // same method, different behavior
                    }

                4. Abstraction

                     --> Hiding complex implementation details and showing only the necessary features of an object.
                     --> Use To reduce complexity and increase focus on essential features.

                    Ex. (using abstract class):

                    abstract class Animal {
                        abstract public function sound(); // abstract method
                    }

                    class Dog extends Animal {
                        public function sound() {
                            echo "Bark!";
                        }
                    }

                    $dog = new Dog();
                    $dog->sound();


                    ➜ The abstract class defines a blueprint; the child class provides the actual implementation.

     Practical Exercise:-
      (1) Create a simple class in PHP that demonstrates encapsulation by using private and public properties and methods.
         
                class BankAccount {
                --> Private property - cannot be accessed directly outside the class.

                    private $balance = 0;

                    // Public method to deposit money
                    public function deposit($amount) {
                        if ($amount > 0) {
                            $this->balance += $amount;
                            echo "Deposited: ₹$amount<br>";
                        } else {
                            echo "Invalid deposit amount!<br>";
                        }
                    }

                    // Public method to withdraw money
                    public function withdraw($amount) {
                        if ($amount > 0 && $amount <= $this->balance) {
                            $this->balance -= $amount;
                            echo "Withdrawn: ₹$amount<br>";
                        } else {
                            echo "Insufficient balance or invalid amount!<br>";
                        }
                    }

                    // Public method to check current balance
                    public function getBalance() {
                        return $this->balance;
                    }
                }

                // Create object
                $account = new BankAccount();

                // Accessing data through methods (not directly)
                $account->deposit(1000);
                $account->withdraw(400);
                echo "Current Balance: ₹" . $account->getBalance();




     Class

     THEORY EXERCISE:-
       (1) Explain the structure of a class in PHP, including properties and methods.
                --> In PHP, a class is a blueprint or template used to create objects.
                --> It defines properties (variables) and methods (functions) that describe the behavior and characteristics of an object.

            Basic Structure of a PHP Class:
                    class ClassName {
                        // Properties (Variables)

                        public $property1;
                        private $property2;


                        // Methods (Functions)
                        public function method1() {
                            echo "This is a public method.<br>";
                        }

                        private function method2() {
                            echo "This is a private method.<br>";
                        }
                    }

                    // Creating an Object
                    $obj = new ClassName();

                    // Accessing Properties & Methods
                    echo $obj->property1;   // Access public property
                    $obj->method1();        // Call public method


       Practical Exercise:- 
       (1) Write a PHP script to create a class representing a "Car" with properties like make, model,
           and year, and a method to display the car details.

                    class Car {
                        // Properties
                        public $make;
                        public $model;
                        public $year;

                        // Constructor to initialize the properties
                        public function __construct($make, $model, $year) {
                            $this->make = $make;
                            $this->model = $model;
                            $this->year = $year;
                        }

                        // Method to display car details
                        public function displayDetails() {
                            echo "Car Details:<br>";
                            echo "Make: " . $this->make . "<br>";
                            echo "Model: " . $this->model . "<br>";
                            echo "Year: " . $this->year . "<br>";
                        }
                    }

                    // Create an object of Car class
                    $car1 = new Car("Toyota", "Corolla", 2022);

                    // Call method to display details
                    $car1->displayDetails();




                    
                    
     Object
     THEORY EXERCISE:-
       (1) What is an object in OOP? Discuss how objects are instantiated from classes in PHP. 
      
           --> In Object-Oriented Programming (OOP), an object is a real-world instance of a class.
           --> It is a self-contained unit that combines both data (properties) and behaviors (methods) defined in the class.
           --> Think of a class as a blueprint, and an object as the actual product built from that blueprint.


           Example Analogy:

            --> Class: Car → Blueprint that defines what a car is (make, model, year).
            --> Object: Car1 → A real car, e.g., Toyota Corolla 2022.
            --> So, objects are individual entities created using the class, each having its own set of property values.

            How Objects are Instantiated from Classes in PHP:
                  --> In PHP, you create (instantiate) an object using the new keyword, followed by the class name.
                  Syntax:
                    $objectName = new ClassName();

               --> If the class has a constructor that requires parameters:
                 $objectName = new ClassName($param1, $param2);


     Practical Exercise:- 
       (1) Instantiate multiple objects of the "Car" class and demonstrate how to access their properties and methods.

            class Car {
                public $make;
                public $model;
                public $year;

                // Constructor to initialize the object
                public function __construct($make, $model, $year) {
                    $this->make = $make;
                    $this->model = $model;
                    $this->year = $year;
                }

                // Method to display car details
                public function displayDetails() {
                    echo "Make: " . $this->make . "<br>";
                    echo "Model: " . $this->model . "<br>";
                    echo "Year: " . $this->year . "<br>";
                }
            }

            // Creating (instantiating) objects from the Car class
            $car1 = new Car("Toyota", "Corolla", 2022);
            $car2 = new Car("Honda", "Civic", 2021);

            // Accessing methods and properties
            $car1->displayDetails();
            echo "<br>";
            $car2->displayDetails();



     Extends

     THEORY EXERCISE:- 
        (1) Explain the concept of inheritance in OOP and how it is implemented in PHP.
            --> It allows a child class (subclass) to inherit properties and methods from a parent class (superclass).
            --> nheritance enables one class to use the code and behavior of another class, reducing code duplication and promoting reusability.
            --> The keyword extends is used to create inheritance in PHP.
            --> The child class (derived class) inherits all public and protected members (properties and methods) from the parent class.
            --> The child class can:
                --> Use inherited members directly
                --> Add new properties and methods 
                --> Override existing methods for customized behavior.

            Ex.
                class ParentClass {
                    // Parent properties and methods
                }

                class ChildClass extends ParentClass {
                    // Child can add or override methods/properties
                }

     
     



     Practical Exercise:- 
        (1) Create a "Vehicle" class and extend it with a "Car" class. Include properties and methods in both classes, 
        demonstrating inherited behavior.

                // Parent Class
                class Vehicle {
                    public $brand;
                    public $color;

                    // Method in parent class
                    public function startEngine() {
                        echo "Engine started.<br>";
                    }

                    public function stopEngine() {
                        echo "Engine stopped.<br>";
                    }

                    public function setDetails($brand, $color) {
                        $this->brand = $brand;
                        $this->color = $color;
                    }
                }

                // Child Class
                class Car extends Vehicle {
                    public $model;
                    public $fuelType;

                    // Method in child class
                    public function setCarDetails($model, $fuelType) {
                        $this->model = $model;
                        $this->fuelType = $fuelType;
                    }

                    // Method to display all details (includes inherited and new properties)
                    public function displayDetails() {
                        echo "Car Details:<br>";
                        echo "Brand: " . $this->brand . "<br>";
                        echo "Color: " . $this->color . "<br>";
                        echo "Model: " . $this->model . "<br>";
                        echo "Fuel Type: " . $this->fuelType . "<br>";
                    }
                }

                // Create object of child class
                $car1 = new Car();

                // Set parent and child properties
                $car1->setDetails("Toyota", "Red");       // from Vehicle class
                $car1->setCarDetails("Corolla", "Petrol"); // from Car class

                // Call parent and child methods
                $car1->startEngine();   // Inherited from Vehicle
                $car1->displayDetails(); // Defined in Car
                $car1->stopEngine();    // Inherited from Vehicle



     Overloading
     THEORY EXERCISE:- 
        (1) Discuss method overloading and how it is implemented in PHP. 
                --> Method overloading is a concept in Object-Oriented Programming where multiple 
                    methods have the same name but different numbers or types of parameters.
                --> It allows a single method name to perform different tasks based on the arguments passed.
                
                Example (in languages like Java or C#):
                 --> class MathOperation {
                        void add(int a, int b) { ... }
                        void add(double a, double b) { ... }  // same name, different parameters
                    }
                 --> However — PHP does not support traditional method overloading like Java or C#
                 --> That means you cannot define multiple methods with the same name in the same class.
                 --> Example of What PHP Does NOT Allow  
                    class Demo {
                        function show($a) {
                            echo "One parameter";
                        }

                        function show($a, $b) {  // Error: redeclaration not allowed
                            echo "Two parameters";
                        }
                    }
                  How Method Overloading Works in PHP:    
                    --> This will produce an error because PHP does not support multiple methods with the same name.
                    --> In PHP, method overloading is achieved dynamically using magic methods:
                    --> __call() → for handling inaccessible or non-existing object methods.
                    --> __callStatic() → for handling inaccessible or non-existing static methods.

                 Ex.

                    public function __call($name, $arguments) {
                        // $name → method name being called
                        // $arguments → array of arguments passed
                    }


                   

     Practical Exercise:-
        (1) Create a class that demonstrates method overloading by defining multiple methods withthesame name but different parameters.
              class Calculator {
                        // Magic method to simulate overloading
                        public function __call($name, $arguments) {
                            if ($name == "add") {
                                $count = count($arguments);
                                if ($count == 2) {
                                    echo "Sum of two numbers: " . ($arguments[0] + $arguments[1]) . "<br>";
                                } elseif ($count == 3) {
                                    echo "Sum of three numbers: " . ($arguments[0] + $arguments[1] + $arguments[2]) . "<br>";
                                } else {
                                    echo "Invalid number of arguments.<br>";
                                }
                            }
                        }
                    }

                    // Create object
                    $calc = new Calculator();

                    // Call same method name with different parameters
                    $calc->add(10, 20);       // Calls __call() internally
                    $calc->add(5, 15, 25);    // Also calls __call()


     Abstraction Interface
     THEORY EXERCISE: 
        (1) Explain the concept of abstraction and the use of interfaces in PHP. 
            --> Abstraction means representing only the essential features of an object while hiding the unnecessary details.
            --> It helps reduce complexity and increases focus on what an object does, rather than how it does it.

             Real-life Example:-
                 When you drive a car:
                   --> You only interact with the steering wheel, brakes, and accelerator (essential features).
                   --> You don’t see the complex mechanics of the engine, fuel injection, etc. (hidden details).

            --> PHP implements abstraction in two main ways:        
               1. Abstract Classes
               2. Interfaces


                    1. Abstract Classes

                        An abstract class:
                         --> Cannot be instantiated directly.
                         --> Can contain abstract methods (without a body) and regular methods (with implementation).
                         --> Must be extended by another class that provides implementations for the abstract methods.
                         Example: Abstract Class
                                abstract class Vehicle {
                                    // Abstract method (must be implemented by child classes)
                                    abstract public function startEngine();

                                    // Regular method (can be inherited directly)
                                    public function fuelType() {
                                        echo "This vehicle uses fuel.<br>";
                                    }
                                }

                                class Car extends Vehicle {
                                    // Implementing abstract method
                                    public function startEngine() {
                                        echo "Car engine started with key.<br>";
                                    }
                                }

                                // $v = new Vehicle();  Not allowed (abstract classes cannot be instantiated)
                                $car = new Car();
                                $car->startEngine();
                                $car->fuelType();
                   
                    2. Interfaces in PHP
                         --> An interface is similar to an abstract class but is more strict:
                         --> It only declares methods — no implementation allowed.
                         --> A class that implements an interface must define all its methods.
                         --> Interfaces support multiple inheritance (a class can implement multiple interfaces).
                         Example: Interface in PHP 
                                interface Vehicle {
                                    public function startEngine();
                                    public function stopEngine();
                                }

                                class Car implements Vehicle {
                                    public function startEngine() {
                                        echo "Car engine started.<br>";
                                    }

                                    public function stopEngine() {
                                        echo "Car engine stopped.<br>";
                                    }
                                }

                                $car = new Car();
                                $car->startEngine();
                                $car->stopEngine();

                         
     
     
     
     Practical Exercise:    
        (1) Define an interface named VehicleInterface with methods like start(), stop(), andimplement this interface in multiple classes.

                 // Define an interface
                interface VehicleInterface {
                    public function start();
                    public function stop();
                }

                // Class 1: Car implements VehicleInterface
                class Car implements VehicleInterface {
                    public function start() {
                        echo "Car engine started.<br>";
                    }

                    public function stop() {
                        echo "Car engine stopped.<br>";
                    }
                }

                // Class 2: Bike implements VehicleInterface
                class Bike implements VehicleInterface {
                    public function start() {
                        echo "Bike engine started.<br>";
                    }

                    public function stop() {
                        echo "Bike engine stopped.<br>";
                    }
                }

                // Create objects
                $car = new Car();
                $bike = new Bike();

                // Call interface methods
                $car->start();
                $car->stop();

                $bike->start();
                $bike->stop();

     Constructor
     THEORY EXERCISE:
        (1) What is a constructor in PHP? Discuss its purpose and how it is used.
            --> A constructor is a special method in a PHP class that is automatically called whenever a new object of that class is created.
            --> It is defined using the magic method:
                __construct()
            
            Purpose of a Constructor:
              --> The main purpose of a constructor is to initialize object properties when an object is created — so we don’t have 
                  to set values manually later.
            Syntax:
                class ClassName {
                    public function __construct() {
                        // Initialization code here
                    }
                }
        



     Practical Exercise: 
        (1) Create a class with a constructor that initializes properties when an object is created.
                class Car {
                    public $brand;
                    public $model;
                    public $year;

                    // Constructor to initialize properties
                    public function __construct($brand, $model, $year) {
                        $this->brand = $brand;
                        $this->model = $model;
                        $this->year = $year;
                    }

                    public function displayInfo() {
                        echo "Car: {$this->brand} {$this->model} ({$this->year})";
                    }
                }

                // Create an object (constructor automatically runs)
                $car1 = new Car("Toyota", "Corolla", 2022);
                $car1->displayInfo();
     
     Destructor
     THEORY EXERCISE: 
        (1) Explain the role of a destructor in PHP and when it is called. 
           --> A destructor is a special method in a PHP class that is automatically called when an object is destroyed or the script 
               execution ends.
           --> It is defined using the magic method:
               __destruct()
        
           Purpose of a Destructor:
             --> The main purpose of a destructor is to perform cleanup tasks before the object is removed from memory.

             For example:   
               --> Closing a database connection.
               --> Releasing file handles.
               --> Saving logs or cleanup data.
               --> Displaying a final message before object destruction.
             
             Syntax:  
               class ClassName {
                    public function __destruct() {
                        // Cleanup code here
                    }
                }
  


     Practical Exercise: 
        (1) Write a class that implements a destructor to perform cleanup tasks when an object is destroyed.

                    class Person {
                        private $name;

                        // Constructor – runs automatically when object is created
                        public function __construct($name) {
                            $this->name = $name;
                            echo "Hello, {$this->name}! Object created.<br>";
                        }

                        // A normal method
                        public function greet() {
                            echo "Welcome, {$this->name}!<br>";
                        }

                        // Destructor – runs automatically when object is destroyed
                        public function __destruct() {
                            echo "Goodbye, {$this->name}! Object destroyed.<br>";
                        }
                    }

                    // Create object (constructor runs)
                    $person1 = new Person("Asfak");

                    // Call method
                    $person1->greet();

                    // When script ends, destructor runs automatically
     
     Magic Methods
     THEORY EXERCISE: 
        (1) Define magic methods in PHP. Discuss commonly used magic methods like __get(), __set(), and __construct().
                --> Magic methods are special built-in methods in PHP classes that start with double underscores (__).
                --> They are automatically called by PHP when certain actions happen — like creating an object or accessing a private property.


                     Method                                     When it runs                                         What it does                      |
              ---------------------- | ----------------------------------------------------------------- | --------------------------------- 
              __construct()          | When object is created                                            | Used to set or initialize values. 
              __get($name)           | When trying to read a private or non-existing property            | Used to access hidden data.       
              __set($name, $value)   | When trying to assign value to a private or non-existing property | Used to set hidden data.          



     
     Practical Exercise: 
        (1) Create a class that uses magic methods to handle property access and modification dynamically.

                    class Person {
                        private $data = [];

                        // Constructor (runs when object is created)
                        public function __construct($name) {
                            $this->data['name'] = $name;
                            echo "Object created for {$this->data['name']}<br>";
                        }

                        // __set() - runs when setting private property
                        public function __set($key, $value) {
                            $this->data[$key] = $value;
                        }

                        // __get() - runs when accessing private property
                        public function __get($key) {
                            return $this->data[$key];
                        }
                    }

                    // Create object
                    $p1 = new Person("Asfak");

                    // Use __set()
                    $p1->age = 25;

                    // Use __get()
                    echo "Name: " . $p1->name . "<br>";
                    echo "Age: " . $p1->age;

     Scope Resolution
     THEORY EXERCISE: 
        (1) Explain the scope resolution operator (::) and its use in PHP.
            --> The Scope Resolution Operator (::) is used in PHP to access class properties and methods that belong to a class itself, 
                rather than an object.
            --> The :: operator is used without creating an object — it directly accesses class-level members (static or constant).
            
            --> It is mainly used to access:
                --> Static properties
                --> Static methods
                --> Constants
                --> Parent class members (using parent::)

                    self::      --> Refers to current class             
                    parent::    --> Refers to parent class              
                    ClassName:: --> Refers to a specific class directly 






     Practical Exercise: 
        (1) Create a class with static properties and methods, and demonstrate their access using thescope resolution operator.         
        
                class Car {
                    // Static property
                    public static $brand = "Toyota";

                    // Static method
                    public static function displayBrand() {
                        echo "The car brand is " . self::$brand . "<br>";
                    }
                }

                // Access static property using ::
                echo Car::$brand . "<br>";

                // Access static method using ::
                Car::displayBrand();


     Traits
     THEORY EXERCISE: 
        (1) Define traits in PHP and their purpose in code reuse. 
            --> A Trait in PHP is a mechanism that allows code reuse in multiple classes.
            --> Traits are like mini-classes that contain methods (and sometimes properties) that can be used (or “mixed in”) by other classes.
            --> They help to avoid code duplication and provide a way to share common functionality between classes without using inheritance.
            
            Purpose of Traits:
              Traits are used when:
                --> You want to reuse common methods across multiple classes.
                --> Inheritance alone is not enough (because PHP supports only single inheritance).
                --> You want to avoid repeating the same code in different classes.
            
            Syntax:
                trait TraitName {
                    // properties
                    // methods
                }
               
             --> Then, use it in a class like this:
                    class ClassName {
                        use TraitName;
                    }


     Practical Exercise: 
        (1) Create two traits and use them in a class to demonstrate how to include multiple behaviors.           

                    // First trait
                    trait Engine {
                        public function startEngine() {
                            echo "Engine started.<br>";
                        }

                        public function stopEngine() {
                            echo "Engine stopped.<br>";
                        }
                    }

                    // Second trait
                    trait MusicSystem {
                        public function playMusic() {
                            echo "Music is playing... 🎵<br>";
                        }

                        public function stopMusic() {
                            echo "Music stopped.<br>";
                        }
                    }

                    // Class using both traits
                    class Car {
                        use Engine, MusicSystem; // Using multiple traits

                        public function drive() {
                            echo "Car is driving smoothly.<br>";
                        }
                    }

                    // Create object
                    $myCar = new Car();

                    // Access methods from both traits
                    $myCar->startEngine();
                    $myCar->playMusic();
                    $myCar->drive();
                    $myCar->stopMusic();
                    $myCar->stopEngine();



     Visibility
     THEORY EXERCISE: 
        (1) Discuss the visibility of properties and methods in PHP (public, private, protected). 

            --> Visibility defines how and where properties and methods of a class can be accessed 
                whether from inside the class, outside the class, or from inherited (child) classes.

            --> 
                 Modifier    | Accessible Inside Class | Accessible in Child Class | Accessible Outside Class 
                             |                         |                           | 
                 public      |  Yes                    | Yes                       |  Yes                    
                 protected   |  Yes                    | Yes                       |  No                     
                 private     |  Yes                    | No                        |  No                     

     
     Practical Exercise: 
        (1) Write a class that shows examples of each visibility type and how they restrict access to properties and methods.
                    
                        class BankAccount {
                            // Public property: accessible anywhere
                            public $accountHolder = "John Doe";

                            // Protected property: accessible inside class & subclasses only
                            protected $balance = 5000;

                            // Private property: accessible only inside this class
                            private $pin = 1234;

                            // Public method: can be called from anywhere
                            public function showAccountInfo() {
                                echo "Account Holder: " . $this->accountHolder . "<br>";
                                echo "Balance: ₹" . $this->balance . "<br>";
                                echo "PIN: " . $this->pin . "<br>";
                            }

                            // Protected method: can be used only by this class or subclasses
                            protected function deposit($amount) {
                                $this->balance += $amount;
                                echo "Deposited ₹$amount successfully.<br>";
                            }

                            // Private method: accessible only inside this class
                            private function showPIN() {
                                echo "Your PIN is: " . $this->pin . "<br>";
                            }

                            // Method to access private method safely
                            public function accessPrivateMethod() {
                                $this->showPIN();
                            }
                        }

                        // Subclass
                        class SavingsAccount extends BankAccount {
                            public function addInterest() {
                                // Accessing protected property and method (allowed)
                                $this->balance += 500;
                                echo "Interest added! New balance: ₹" . $this->balance . "<br>";

                                // $this->pin;  Not allowed — private property
                                // $this->showPIN();  Not allowed — private method
                            }
                        }

                        // Create objects
                        $account = new SavingsAccount();

                        //  Public property — accessible anywhere
                        echo $account->accountHolder . "<br><br>";

                        //  Protected or Private — not accessible from outside
                        // echo $account->balance;  // Error
                        // echo $account->pin;      // Error

                        //  Access public method
                        $account->showAccountInfo();

                        //  Access method that uses protected feature
                        $account->addInterest();

                        //  Access private method safely through a public method
                        $account->accessPrivateMethod();


     Type Hinting
     THEORY EXERCISE: 
        (1) Explain type hinting in PHP and its benefits. 

            --> Type hinting (also called type declaration) means specifying the expected data type of a variable, parameter, 
                or function return value in PHP.
            --> It tells PHP (and other developers) what type of value a function or method should 
                receive or return — like int, string, array, object, etc.
            --> If a value of the wrong type is passed, PHP will throw a TypeError.

            Example: Without Type Hinting:
                  function add($a, $b) {
                        return $a + $b;
                    }

                    echo add(5, 10);      //  Works fine
                    echo add("5", "10");  //  Works (but PHP converts strings to numbers)      

                --> Here, PHP automatically converts data types ,which can cause unexpected behavior.
            
            Example: With Type Hinting:
                  function add(int $a, int $b): int {
                        return $a + $b;
                    }

                    echo add(5, 10);       //  Works fine
                    echo add("5", "10");   //  TypeError (string not allowed)

                --> Now PHP enforces that both $a and $b must be integers, and the return value must also be an integer.

            Benefits of Type Hinting:

                --> Fewer bugs — prevents passing wrong data types.
                --> Clearer code — easy to understand what type a function expects.
                --> Better IDE support — editors can auto-suggest correct types.
                --> More reliable code — PHP validates data before running logic.
                --> Improved debugging — type mismatches are caught early.

     Practical Exercise: 
        (1) Write a method in a class that accepts type-hinted parameters and demonstrate how it works with different data types.
                   
                        class Calculator {
                        // Method with type-hinted parameters and return type
                        public function addNumbers(int $a, int $b): int {
                            return $a + $b;
                        }

                        public function greetUser(string $name): string {
                            return "Hello, " . $name . "!";
                        }

                        public function calculateDiscount(float $price, float $discount): float {
                            return $price - ($price * $discount / 100);
                        }
                    }

                    // Create object
                    $calc = new Calculator();

                    //  Correct data types
                    echo $calc->addNumbers(10, 20) . "<br>";       // Works fine
                    echo $calc->greetUser("Asfak") . "<br>";       // Works fine
                    echo $calc->calculateDiscount(500.0, 10.5);    // Works fine

                    //  Incorrect data types (will cause TypeError)
                    // echo $calc->addNumbers("10", "20");  // Error: Expected int
                    // echo $calc->greetUser(123);          // Error: Expected string
     
     Final Keyword
     THEORY EXERCISE: 
        (1) Discuss the purpose of the final keyword in PHP and how it affects classes and methods. 
            --> The final keyword in PHP is used to restrict inheritance or overriding.It can be applied to classes or methods.
            
            1. Purpose of final in Classes:
               --> When a class is declared as final,it cannot be inherited by any other class.

            Example:
                final class Vehicle {
                    public function start() {
                        echo "Vehicle started.";
                    }
                }

                // This will cause an error
                // class Car extends Vehicle { }  // Error: Cannot extend final class

            --> Because Vehicle is declared as final, no other class can extend it.

            2. Purpose of final in Methods:
               --> When a method is declared as final, it cannot be overridden in any subclass.
            
               Example:
                    class Vehicle {
                        final public function start() {
                            echo "Vehicle started.<br>";
                        }

                        public function stop() {
                            echo "Vehicle stopped.<br>";
                        }
                    }

                    class Car extends Vehicle {
                        //  This will cause an error
                        // public function start() {
                        //     echo "Car started differently.<br>";
                        // }
                        
                        public function stop() {
                            echo "Car stopped safely.<br>";
                        }
                    }

                    $car = new Car();
                    $car->start();  // Works fine, uses parent's version
                    $car->stop();   // Child method overrides parent

                        --> The start() method is marked as final, so it cannot be changed in the child class.
                        --> The stop() method is not final, so it can be overridden.

     Practical Exercise: 
        (1) Create a class marked as final and attempt to extend it to show the restriction

                    
                    // Declare a final class
                    final class Vehicle {
                        public function start() {
                            echo "Vehicle started.<br>";
                        }
                    }

                    //  Attempt to extend a final class (this will cause an error)
                    class Car extends Vehicle {
                        public function drive() {
                            echo "Car is driving.<br>";
                        }
                    }

                    // Create object
                    $car = new Car();
                    $car->start();
                    $car->drive();

     Session and Cookies
     THEORY EXERCISE: 
        (1) Explain the differences between sessions and cookies in PHP.
            --> Both cookies and sessions are used to store user data and maintain state between pages but 
                they work differently in where and how the data is stored.

                1. Cookies:-
                   --> A cookie is a small piece of data stored on the user’s browser (client-side).

                   Key Points:
                       --> Stored on the client’s computer.
                       --> Sent to the server with every request.
                       --> Can be used to remember user preferences, like “Remember Me” login.
                       --> Can have an expiration time.
                       --> Less secure, since data is visible to users.
                       --> Use cookies for non-sensitive, long-term data.
                   Example:

                        // Set a cookie
                        setcookie("username", "Asfak", time() + 3600); // expires in 1 hour

                        // Access cookie
                        if (isset($_COOKIE["username"])) {
                            echo "Welcome, " . $_COOKIE["username"];
                        } else {
                            echo "Cookie not set!";
                        }

                2. Sessions:-
                   --> A session stores data on the server, and only a unique session ID is stored in the browser.

                       Key Points:
                           --> Stored on the server-side.
                           --> More secure than cookies.
                           --> Used to store sensitive or temporary data (like login info).
                           --> Session data is destroyed when the browser is closed or after timeout.
                           --> Use sessions for sensitive or temporary data like login details.

                        Example:-
                          
                           session_start(); // Start the session

                            // Store data in session
                            $_SESSION["username"] = "Asfak";

                            // Access session data
                            echo "Welcome, " . $_SESSION["username"];

                            // Destroy session
                            // session_destroy();

                        Comparison Table:-

                             Feature              |   Cookies                          |  Sessions                            
                             -------------------- | ---------------------------------- | --------------------------------------- 
                             Storage Location     | Client-side (browser)              | Server-side                             
                             Security**           | Less secure                        | More secure                             
                             Data Size Limit      | ~4KB                               | No practical limit                      
                             Lifetime**           | Until expiry time or manual delete | Until browser closes or session timeout 
                             Accessibility        | Accessible via browser tools       | Hidden from user                        
                             Use Case             | Save preferences, remember user    | Login data, user authentication         


     Practical Exercise: 
        (1) Write a script to create a session and store user data, and then retrieve it on a different page. Also, 
            demonstrate how to set and retrieve a cookie.


            Page 1: set_data.php
                 
                   --> This page creates a session and sets a cookie.

                    // Start the session
                    session_start();

                    // Store user data in session
                    $_SESSION["username"] = "Asfak";
                    $_SESSION["email"] = "asfak@example.com";

                    // Set a cookie (valid for 1 hour)
                    setcookie("user_city", "Rajkot", time() + 3600);

                    echo " Session and Cookie have been set successfully.<br>";
                    echo "<a href='get_data.php'>Go to next page</a>";
            
            Page 2: get_data.php

                   --> this page retrieves session and cookie data.

                    // Start session again to access stored data
                    session_start();

                    echo "<h3> Retrieved Session Data:</h3>";

                    // Check if session data exists
                    if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
                        echo "Username: " . $_SESSION["username"] . "<br>";
                        echo "Email: " . $_SESSION["email"] . "<br>";
                    } else {
                        echo "No session data found.<br>";
                    }

                    echo "<h3> Retrieved Cookie Data:</h3>";

                    // Check if cookie exists
                    if (isset($_COOKIE["user_city"])) {
                        echo "City: " . $_COOKIE["user_city"] . "<br>";
                    } else {
                        echo "No cookie found.<br>";
                    }

            How It Works:
                --> Run set_data.php first → it creates a session & sets a cookie.
                --> Then go to get_data.php → it retrieves and displays that data.   
                
                







    Email Security Function
    THEORY EXERCISE:
        (1) Explain the importance of email security and common practices to ensure secure email transmission.
            --> Email is one of the most commonly used communication channels in web applications (password resets, OTPs, invoices, notifications). 
                If email security is weak, it can lead to data breaches, fraud, and system compromise.

            -->Common Practices to Ensure Secure Email Transmission:
                1. Use SMTP over SSL/TLS (Encryption)
                    Most important practice
                     -->Encrypts email data during transmission.
                     -->Prevents attackers from reading intercepted emails.
                     ex.$mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'your@email.com';
                        $mail->Password = 'app_password';
                        $mail->SMTPSecure = 'tls'; // or ssl
                        $mail->Port = 587;
                    -->Protects against data sniffing
                    -->Prevents MITM attacks
                2. Use Secure Email Libraries (Avoid mail())
                    Avoid PHP’s default mail() function.
                    Recommended libraries:
                    PHPMailer
                    SwiftMailer
                    Symfony Mailer
                3. Validate & Sanitize Email Inputs
                    Prevents header injection and abuse.
                 --> $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                 --> Prevents malicious email headers
                 --> Stops spam abuse
                
                4. Limit Email Sending (Rate Limiting)

                    Protects against:
                        Email bombing
                        Brute-force OTP attempts

                    --> Use CAPTCHA
                    --> Limit requests per IP/user
                5. Use App Passwords or API Keys (Not Real Passwords)
                    --> For services like:
                    --> Gmail
                    --> SendGrid
                    --> Mailgun
                    --> More secure
                    --> Easy to revoke
                    --> No exposure of main password

    Practical Exercise: 
        (1) Write a function that sanitizes email input and validates it before sending
        --> PHP Function: Sanitize & Validate Email
                /**
                * Sanitize and validate an email address
                *
                * @param string $email
                * @return string|false  Returns sanitized email or false if invalid
                
                    function sanitizeAndValidateEmail(string $email)
                    {
                        // Step 1: Trim whitespace
                        $email = trim($email);
                    
                        // Step 2: Sanitize email
                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    
                        // Step 3: Validate email format
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            return false;
                        }
                    
                        // Step 4: Prevent header injection
                        if (preg_match('/[\r\n]/', $email)) {
                            return false;
                        }
                    
                        return $email;
                    }
        --> How to Use the Function:
                 $email = $_POST['email'] ?? '';

                $cleanEmail = sanitizeAndValidateEmail($email);

                if ($cleanEmail === false) {
                    echo "Invalid email address";
                    exit;
                }

                // Safe to send email
                sendEmail($cleanEmail);




    File Handling
    THEORY EXERCISE: 
        (1) Discuss file handling in PHP, including opening, reading, writing, and closing files. 
             --> File handling in PHP allows developers to create, read, write, update, and delete files stored on the server. 
                 It is commonly used for logging, reports (CSV/PDF), file uploads, backups, and configuration storage.  
                    1. Opening a File (fopen())
                        -->The fopen() function is used to open a file in a specific mode.
                        Syntax: fopen(filename, mode);

                        | Mode | Description                          |
                        | ---- | ------------------------------------ |
                        | r    | Read only (file must exist)          |
                        | w    | Write only (creates/overwrites file) |
                        | a    | Append (writes at end)               |
                        | r+   | Read & write                         |
                        | w+   | Read & write (overwrites)            |
                        | a+   | Read & append                        |
                        | x    | Create new file, fail if exists      |

                        ex: $file = fopen("data.txt", "r");

                    2. Reading Files in PHP
                     (a) Reading Entire File – file_get_contents()
                         $content = file_get_contents("data.txt");
                         echo $content;
                      --> Simple and fast
                      --> Not ideal for large files

                     (b) Reading Line by Line – fgets()
                         $file = fopen("data.txt", "r");
                        while (!feof($file)) {
                            echo fgets($file);
                        }
                        fclose($file);
                    --> Efficient for large files
                     
                    (c) Reading Character by Character – fgetc()
                       $file = fopen("data.txt", "r");
                       while (($char = fgetc($file)) !== false) {
                           echo $char;
                       }
                       fclose($file);

                    3. Writing to Files
                     (a) Write Mode (w) – Overwrites File
                        $file = fopen("data.txt", "w");
                        fwrite($file, "Hello PHP\n");
                        fclose($file);
                     
                     (b) Append Mode (a) – Adds Data
                        $file = fopen("data.txt", "a");
                        fwrite($file, "New line added\n");
                        fclose($file);
                       
                     (c) Writing Arrays as CSV – fputcsv()
                        $file = fopen("students.csv", "a");
                        $data = ["John", 85, "A"];
                        fputcsv($file, $data);
                        fclose($file);
                    4. Closing a File (fclose())
                      -->Always close files after operations to:
                      -->Free system resources
                      -->Prevent file corruption
                      -->Avoid file locks
                        ex.fclose($file);
               
                    5. Checking File Existence & Permissions
                        Check if File Exists
                        if (file_exists("data.txt")) {
                            echo "File exists";
                        }

                        Check Read/Write Permission
                        is_readable("data.txt");
                        is_writable("data.txt");
                    
                    6. Deleting & Renaming Files
                      -->Delete a File
                        ex.unlink("data.txt");

                      -->Rename a File
                        ex.rename("old.txt", "new.txt");    
    Practical Exercise:
        (1) Create a script that reads from a text file and displays its content on a web page.            
            Step 1: Create a Text File
              Create a file named sample.txt in the same directory:
                        Welcome to PHP File Handling.
                        This content is read from a text file.
                        File handling is easy in PHP.
            
            Step 2: PHP Script to Read & Display File Content
               --> Using file_get_contents():-
                   <?php
                    $filename = "sample.txt";

                    if (file_exists($filename)) {
                        $content = file_get_contents($filename);
                        echo nl2br(htmlspecialchars($content));
                    } else {
                        echo "File not found.";
                    }
                    ?>


                   Note:- file_exists() → checks if file is available
                          file_get_contents() → reads entire file
                          htmlspecialchars() → prevents XSS attacks
                          nl2br() → converts new lines to <br> for HTML display


    Handling Emails
    THEORY EXERCISE: 
            (1) Explain how to send emails in PHP using the mail() function and the importance of
                validating email addresses.

                Sending Email using mail():

                  --> PHP uses the built-in mail() function to send emails.       
                  --> It requires the recipient address, subject, message, and headers.
                    Example:
                       mail($to, $subject, $message, $headers);
                  --> It is simple but has limited security and error handling.

                Importance of Validating Email Addresses:
                  -->  Ensures the email format is correct and real.
                  -->  Prevents email header injection attacks.
                  -->  Reduces email bounce rate.
                  -->  Improves email deliverability.
                  -->  Protects the server from spam misuse.

    
    MVC Architecture
    THEORY EXERCISE: 
            (1) Discuss the Model-View-Controller (MVC) architecture and its advantages in web
                development.
             --> MVC is a software design pattern that divides a web application into three interconnected components: Model, View, and Controller. 
                 This separation helps organize code, improve maintainability, and make development more efficient.

                    1. Model
                        -->Represents the data layer of the application.
                        -->Handles business logic, database operations (CRUD), and data validation.
                        -->Communicates with the database.
                        -->Example: User, Product, Invoice models in PHP/Laravel.
                        Role:
                         --> What data the app works with and how it is processed.
                    2. View

                        -->Represents the presentation layer (UI).
                        -->Displays data to the user (HTML, CSS, Bootstrap, Blade templates).
                        -->Does not contain business logic.
                        -->Receives data from the Controller.
                        -->Role:
                           --> How the data is shown to the user.
                    3. Controller
                        -->Acts as an intermediary between Model and View.
                        -->Handles user requests (form submissions, URL requests).
                        -->Fetches or updates data via the Model.
                        -->Passes data to the View.
                        Role:
                          --> Controls the flow of the application
            
            --> Advantages of MVC Architecture in Web Development:
                    1. Separation of Concerns
                    -->Logic, UI, and data are separated.
                    -->Easier to understand and manage large applications.
                    2. Better Maintainability
                    -->Changes in UI do not affect business logic.
                    -->Database changes rarely affect views.
                    3. Reusability of Code
                    -->Models can be reused in multiple controllers.
                    -->Views can be reused with different data.
                    4. Faster Development
                    -->Multiple developers can work simultaneously:
                    -->One on UI (View)
                    -->One on logic (Controller)
                    -->One on database (Model)
                    5. Scalability
                    -->Ideal for large and complex applications.
                    -->Easy to add new features without breaking existing code.
                    6. Easier Testing & Debugging
                    -->Each component can be tested independently.
                    -->Bugs are easier to locate.
                    7. Framework Support
                    -->Popular frameworks use MVC:
                        -->Laravel (PHP)
                        -->Django (MTV variant)
                        -->Spring MVC
                        -->ASP.NET MVC

        Connection with MySQL Database
        THEORY EXERCISE: 
              (1) Explain how to connect PHP to a MySQL database using mysqli or PDO. Practical Exercise:
                    1. Connecting PHP to MySQL using MySQLi
                        MySQLi (MySQL Improved) is a PHP extension specifically designed for MySQL databases.
                         a) MySQLi – Procedural Style
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "test_db");               
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }                        
                            echo "Connected successfully";
                            ?>
                         b) MySQLi – Object-Oriented Style
                            <?php
                            $conn = new mysqli("localhost", "root", "", "test_db");                        
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            echo "Connected successfully";
                            ?>
                        --> MySQLi
                            -->Works only with MySQL
                            -->Supports procedural and OOP styles
                            -->Supports prepared statements (secure)    
                
                   2. Connecting PHP to MySQL using PDO (PHP Data Objects)
                    --> PDO is a database abstraction layer that supports multiple databases (MySQL, PostgreSQL, SQLite, etc.).
                    <?php
                    try {
                        $conn = new PDO(
                            "mysql:host=localhost;dbname=test_db",
                            "root",
                            ""
                        );
                    
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        echo "Connected successfully";
                    } catch (PDOException $e) {
                        die("Connection failed: " . $e->getMessage());
                    }
                    ?>

                    --> PDO
                        --> Supports multiple database types
                        --> Uses exception handling
                        --> Supports named & positional prepared statements
                        --> More secure and flexible

                    3. Prepared Statement ExampleS
                        --> MySQLi Prepared Statement
                              $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
                              $stmt->bind_param("ss", $name, $email);
                              $stmt->execute();

                        --> PDO Prepared Statement
                              $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
                              $stmt->execute([
                                  ':name' => $name,
                                  ':email' => $email
                              ]);


     SQL Injection
     THEORY EXERCISE: 
                (1) Define SQL injection and its implications on security
                    --> QL Injection is a security vulnerability in which an attacker inserts malicious SQL code into an application’s 
                        input fields to manipulate the database query executed by the server.
                    --> Implications on Security:
                        --> Attackers can bypass authentication and log in without valid credentials.
                        --> Sensitive data such as usernames, passwords, and personal information can be stolen.
                        --> Database records can be modified or deleted, causing data loss.
                        --> Attackers may gain full control over the database server.
                        --> It can lead to financial loss, data breaches, and loss of user trust.
                    --> SQL injection is a serious threat to web application security and must be prevented using input 
                        validation and prepared statements.          

    File Upload
    THEORY EXERCISE: 
              (1) Discuss file upload functionality in PHP and its security implications.
                  --> File Upload Functionality in PHP allows users to upload files from their local system to the web server using 
                      an HTML form and PHP’s $_FILES superglobal.PHP processes the uploaded file and stores it in a specified directory
                       using functions like move_uploaded_file().
                     --> Working:
                           --> An HTML form uses method="POST" and enctype="multipart/form-data".
                           --> Uploaded file details (name, type, size, temp location) are available in $_FILES.
                           --> PHP validates the file and moves it to a secure folder.
                     --> Security Implications:
                           -->Malicious file upload: Attackers may upload executable scripts (e.g., .php) to gain server access.
                           -->File type spoofing: Fake extensions or MIME types can bypass weak validation.
                           -->Large file uploads: Can cause server overload or denial-of-service (DoS).
                           -->Overwriting files: May replace important server files if filenames are not handled properly.
                           -->Directory traversal: Improper paths may allow access to restricted directories.
                     --> Security Measures:
                         -->Validate file type, extension, and MIME type.
                         -->Limit file size.
                         -->Rename uploaded files and store them outside the web root.
                         -->Disable script execution in upload directories.
                         -->Use proper file and directory permissions.
                  -->Proper validation and handling are essential to prevent serious security risks during file uploads.      
*/
