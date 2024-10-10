<?php 
    //1,2,3 Фантазии хватило вот на такие составляющие библиотеки
//     class Room{
//         private int $id;
//         private int $number;
//         private int $floore;
//         private string $category;
//         private float $squre;
//         private string $state;
        
//         public function __construct(){}
//         public function roomClean(){}
//         public function setRoom(){}
//         public function getRoom(){}
//     }


    
//     class PC{
//         private int $id;
//         private string $state;
//         private array $components;
//         private int $position;
        
//         public function __construct(){}
//         public function roomPC(){}
//         public function setPC(){}
//         public function getPC(){}
//     }
    
//Плавно перетекаем в задание 4 - абстрактная книга и ее развитие в потомках - задание5
   abstract class Book{
        protected  string $book;
        protected bool $is_present;
        protected int $cnt;
        protected int $id;
        protected string $author;
        protected string $title;
        protected int $pages;
        protected string $category;
        
        
        public static int $num=0;
        
        
        public function __construct(int $id,string $author,string $title,int $pages,string $category){
            $this->id=$id;
            $this->author=$author;
            $this->title=$title;
            $this->pages=$pages;
            $this->category=$category;
            $this->book='Book';
            $this->is_present=true;
            $this->cnt=0;
        }
        
        public function getCnt(){
            return $this->cnt;
        }
        
        public function show(){
            echo "<br>";
            echo 
            ' book '.$this->book.
            ', id: '.$this->id.
            ', author: '.$this->author.
            ', title: '.$this->title.
            ', pages: '.$this->pages.
            ', category: '.$this->category.
            ', cnt: '.$this->cnt.
            ', is present: '.$this->is_present;     
        }
        
        abstract public function returnBook();
        
        abstract public function getBook();  
    }
   
    
    class E_Book extends Book{
        private string $url;
        public function __construct(
            int $id,
            string $author,
            string $title,
            int $pages,
            string $category,
            string $url
        ){
            parent::__construct($id,$author,$title,$pages,$category);
            $this->book='E_Book';
            $this->url=$url;
        }
        
        public function show(){
            parent::show();
            echo ', url: '.$this->url."<br>";
        }
        
        public function returnBook(){
            echo "nothing";
        }
        
        public function getBook(){
            $this->cnt++;
            return $this->url;
        }
    }
    

    
    class P_Book extends Book{
        private int $period=3;
        public function __construct(
            int $id,
            string $author,
            string $title,
            int $pages,
            string $category,
            private string $address,
            ){
                parent::__construct($id,$author,$title,$pages,$category);
                $this->book='P_Book';
        }
        
        public function show(){
            parent::show();
            echo ', address: '.$this->address.
                 ', period: '.$this->period."<br>";
        }
        
        public function returnBook(){
            $this->is_present=true;
        }
        
        public function getBook(){
            if($this->is_present){
                $this->cnt++;
                $this->is_present=false;
                return $this->address;
            }else{
                echo "book is absent";
            }
            
        }
    }
    
    
    $book=new E_Book(1,'Author','Book',rand(100,500),'Regester','url');
    $book->show();
    
    
    
    $book1=new P_Book(1,'Author','Book',rand(100,500),'Regester','address');
    $book1->show();
    
    function randCategory(){
        switch(rand(0,4)){
            case 0:return "detective";
            case 1:return "adventure";
            case 2:return "historical novel";
            case 3:return "textbook";
            case 4:return "fantasy";
        }
    }
    
    
    
    $arr=[];
    for($i=0;$i<10;$i++){
        $temp=rand(0,100);
        if($temp<50){
            $arr[]=new E_Book(Book::$num++,'Author'.$i,'Book'.$i,rand(100,500),randCategory(),'url'.$i);
        }else{
            $arr[]=new P_Book(Book::$num++,'Author'.$i,'Book'.$i,rand(100,500),randCategory(),'address'.$i);
        }
    }
    
    
    foreach($arr as $i){
        $i->show();
    }
    
    
    echo "Берем все бумажные книги<br>";
    foreach($arr as $i){
        if($i instanceof P_Book){        
            echo $i->getBook()."<br>";
        }
    }
    foreach($arr as $i){
        $i->show();
    }
    
    echo "Возвращаем все бумажные книги<br>";
    foreach($arr as $i){
        if($i instanceof P_Book){
            $i->returnBook();
        }
    }
    foreach($arr as $i){
        $i->show();
    }
    
    echo "<br>";
    
    //6 
    class A {
        public function foo() {
            static $x = 0;
            echo ++$x;
        }
    }
    $a1 = new A();
    $a2 = new A();
    $a1->foo();
    $a2->foo();
    $a1->foo();
    $a2->foo();
    
//     Что он выведет на каждом шаге? Почему?
//     Переменная х - статичная, поэтому принадлежит всему классу А целиком.
//     Следовательно ее меняют и видят эти изменения все члены класса А -> 1 2 3 4
    
//     Немного изменим п.5
    
    
    class B extends A {
    }
    $a11 = new A();
    $b1 = new B();
    $a11->foo();
    $b1->foo();
    $a11->foo();
    $b1->foo();
    
//     Что он выведет теперь?
//     Наблюдаем, что одна х для класса А, другая - для Б! ->5 1 6 2


?>