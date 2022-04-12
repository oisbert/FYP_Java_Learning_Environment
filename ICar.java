
public class ICar {
   double engineSize;

   public ICar(String brand) {
      System.out.println("This car is a :" + brand );
   }

   public void setEngineSize(double size) {
      engineSize = size;
   }

   public double getEngineSize( ) {
      System.out.println("ICars engine size is :" + engineSize );
      return engineSize;
   }

   public void Beep(){
      System.out.println("Beep, Beep");
   }

   public static void main(String []args) {
      ICar myICar = new ICar("Audi");

      myICar.setEngineSize(1.6);

      myICar.getEngineSize();

      System.out.println("Variable Value :" + myICar.engineSize );
   }
}