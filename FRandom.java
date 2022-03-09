/*
Implement the following interface into class's called:(truck and car)

fix the errors in the code

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
  //finish the code here
}


class Car {
    //implement the interface and finish the code
}
}

public class FRandom {
  public static void main(String[] args) {
    Truck truck = new Truck();
    Car car = new Car();
    truck.driverType();
    truck.vehicleType();
    //Finish the exercise by calling the car methods

  }
}   