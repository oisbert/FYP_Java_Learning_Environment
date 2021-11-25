        public class Hello{
	
	public static void main(String[] args){
		
		Shape s=new Shape();
		Shape s1= new Rectangle();
		s.getArea();
		s1.getArea();
	}
	}

class Shape {
	public void getArea(){
		System.out.println("Shape area");	
	}
}

class Rectangle extends Shape{
	public void getArea(){
		System.out.println("Rtangle area");	
	}
}    