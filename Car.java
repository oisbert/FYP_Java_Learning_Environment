
public class Car {
   double engineSize;

   public Car(String brand) {
      System.out.println("This car is a :" + brand );
   }

   public void setEngineSize(double size) {
      engineSize = size;
   }

   public double getEngineSize( ) {
      System.out.println("Cars engine size is :" + engineSize );
      return engineSize;
   }

   public void Beep(){
      System.out.println("Beep, Beep");
   }

   public static void main(String []args) {
      Car myCar = new Car("Audi");

      myCar.setEngineSize(1.6);

      myCar.getEngineSize();

      System.out.println("Variable Value :" + myCar.engineSize );
   }
}