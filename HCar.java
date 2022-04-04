                                                                                    
public class CCar {
   double engineSize;

   public CCar(String brand) {
      System.out.println("This r is a :" + brand );
   }

   public void setEngineSize(double size) {
      engineSize = size;
   }

   public double getEngineSize( ) {
      System.out.println("HCars engine size is :" + engineSize );
      return engineSize;
   }

   public void Beep(){
      System.out.println("Beep, Beep");
   }

   public static void main(String []args) {
      CCar myCCar = new CCar("Audi");

      myCCar.setEngineSize(1.6);

      myCCar.getEngineSize();

      System.out.println("Variable Value :" + myCCar.engineSize );
   }
}             