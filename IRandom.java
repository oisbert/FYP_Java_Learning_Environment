public class IRandom{
    private String symbol;
    private String name;
    private double previousClosingPrice; 
    private double currentPrice;

    public IRandom(String symbol, String name){
        this.symbol = symbol;
        this.name = name;
    }

    //Add method named getChangePercent() that returns the percentage changed from the previousClosingPrice to the currentPrice
    public double getChangePercentage(){
        return (((currentPrice -previousClosingPrice)/(previousClosingPrice))*100);
    }

    public String GetSymbol(){
        return symbol;
    }

    public String GetName(){
        return name;
    }

    public double EnterpreviousClosingPrice(double previousClosingPrice){
        this.previousClosingPrice = previousClosingPrice;
        return previousClosingPrice;

    }

    public double Entercurrentprice(double currentPrice){
        this.currentPrice = currentPrice;
        return currentPrice;
    }

    public static void main(String []args) {
      /* Object creation */
    IRandom test = new IRandom("LKSS", "Limerick Software Solutions");


    System.out.println(test.GetSymbol());
    System.out.println(test.GetName());
    /* print out the answer here */   
    
   }

}