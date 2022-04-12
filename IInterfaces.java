// Interface
interface Animal {
  public void animalSound(); 
  public void NumberOfLegs(); 
}

// Lion "implements" the Animal interface
class Lion implements Animal {
  public void animalSound() {
    System.out.println("Rawr");
  }
  public void NumberOfLegs() {
    System.out.println("4");
  }
}

// Lion "implements" the Animal interface
class Duck implements Animal {
  public void animalSound() {
    System.out.println("Quak");
  }
  public void NumberOfLegs() {
    System.out.println("2");
  }
}

public class IInterfaces {
  public static void main(String[] args) {
    Lion myLion = new Lion();
    Duck myDuck = new Duck();  
    myLion.animalSound();
    myLion.NumberOfLegs();
    myDuck.animalSound();
    myDuck.NumberOfLegs();
  }
}