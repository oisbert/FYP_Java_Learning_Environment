                                                
public class Polymorphism {
    public static void main(String[] args) {
        Square s = new Square();
        Square s1 = new Circle();
        s.name();
        s1.name();
        s.getArea();
        s.getColour();
        s1.getArea();
        s1.getColour();
    }
}
class Square {
    public void getArea() {
        System.out.println("24");
    }
    public void getColour() {
        System.out.println("red");
    }
    public void name() {
        System.out.println("square");
    }
}

class Circle extends Square {
    public void name() {
        System.out.println("circle");
    }
}                                                                                                                                                                                                                  