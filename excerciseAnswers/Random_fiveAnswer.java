/*
Implement the following interface into class's called:(truck and car)

the driverType method implemented in truck should output:truckDriver
the vehicleType method implemented in truck should output:truck

the driverType method implemented in car should output:carDriver
the vehicleType method implemented in car should output:car

*/
interface vehicle {
  public void driverType(); 
  public void vehicleType(); 
}


class Truck implements vehicle {
  public void driverType() {
    System.out.println("truckDriver");
  }
  public void vehicleType() {
    System.out.println("truck");
  }
}


class Car implements vehicle {
  public void driverType() {
    System.out.println("carDriver");
  }
  public void vehicleType() {
    System.out.println("car");
  }
}

public class Random {
  public static void main(String[] args) {
    Truck truck = new Truck();
    Car car = new Car();  
    truck.driverType();
    truck.vehicleType();
    car.driverType();
    car.vehicleType();
  }
} 