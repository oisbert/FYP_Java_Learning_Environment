public class Rectangle {
    private double width;
    private double height;

    public Rectangle() {
        width = 1.0;
        height = 1.0;
    }

    public Rectangle(double width, double height) {
        this.width = width;
        this.height = height;
    }

    public double getArea() {
        return this.width * this.height;
    }

    public double getPerimeter() {
        return (this.height) * 2 + (this.width * 2);
    }

    public double getWidth() {
        return this.width;
    }

    public double getHeight() {
        return this.height;
    }

    public static void main(String[] args) {

        Rectangle test = new Rectangle();
        System.out.println("The width of the rectangle is : " + test.getWidth());
        System.out.println("The height of the rectangle is : " + test.getHeight());
        System.out.println("The perimeter of the rectangle is : " + test.getPerimeter());
        System.out.println("The area of the rectangle is : " + test.getArea());
        System.out.println();

        Rectangle test2 = new Rectangle(4, 5.5);
        System.out.println("The width of the second rectangle is : " + test2.getWidth());
        System.out.println("The height of the second rectangle is : " + test2.getHeight());
        System.out.println("The perimeter of the second rectangle is : " + test2.getPerimeter());
        System.out.println("The area of the second rectangle is : " + test2.getArea());
    }
}