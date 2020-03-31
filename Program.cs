using System;
using System.Data.SqlClient;
using System.Collections.Generic;
using baileysoft.Wmi;
using System.Text;
using System.Timers;

namespace CPU_Sentinel
{
    class Program
    {

        private static System.Timers.Timer timer;
        static void Main(string[] args)
        {
            // Sets Timer to Execute every 5 seconds.
            setTimer(15000);

            Console.WriteLine("\nPress the Enter key to exit the application...\n");
            Console.WriteLine("The application started at {0:HH:mm:ss.fff}", DateTime.Now);
            Console.ReadLine();
            timer.Stop();
            timer.Dispose();
        }

        private static void setTimer(double interval)
        {
            // Create a timer with a two second interval.
            timer = new System.Timers.Timer(interval);
            // Hook up the Elapsed event for the timer. 
            timer.Elapsed += OnTimedEvent;
            timer.AutoReset = true;
            timer.Enabled = true;
        }

        private static void OnTimedEvent(Object source, ElapsedEventArgs e)
        {
            var dictionary = collectData();
            sendData(dictionary);
        }


        static void sendData(Dictionary<string, Dictionary<string, string>> data)
        {
            try
            {
                SqlConnectionStringBuilder builder = new SqlConnectionStringBuilder();
                builder.DataSource = "cpu-sentinel.database.windows.net";
                builder.UserID = "ibrahimchiha";
                builder.Password = "password~~Ibrahim97";
                builder.InitialCatalog = "cpu_sentinel";


                using (SqlConnection connection = new SqlConnection(builder.ConnectionString))

                {
                    Console.WriteLine("\n Data was successfully sent! \n");
                }
            } catch (SqlException e)
            {
                Console.WriteLine(e.ToString());
            }
            Console.ReadLine();
        }

    
        static Dictionary<string, Dictionary<string, string>> collectData()
        {
            Connection wmiConnection = new Connection();
            Win32_Battery battery = new Win32_Battery(wmiConnection);
            Win32_Processor processor = new Win32_Processor(wmiConnection);
            Win32_PhysicalMemory memory = new Win32_PhysicalMemory(wmiConnection);
            Win32_DiskDrive drive = new Win32_DiskDrive(wmiConnection);
            Win32_BaseBoard board = new Win32_BaseBoard(wmiConnection);

            Console.WriteLine("Success!");
            Console.WriteLine();
            Console.WriteLine("Collecting Battery Information");

            Dictionary<string, string> batteryDictionary =
            new Dictionary<string, string>();
            foreach (string property in battery.GetPropertyValues()) //enumerate the collection
            {
                var keys = property.Split(":");
                var key = keys[0].Trim();
                var value = keys[1].Trim();

                if (key == "EstimatedChargeRemaining")
                {
                    batteryDictionary.Add(key, value);
                }

                if (key == "EstimatedRunTime")
                {
                    batteryDictionary.Add(key, value);
                }

                if (key == "Status")
                {
                    batteryDictionary.Add(key, value);
                }

                if (key == "DesignVoltage")
                {
                    batteryDictionary.Add(key, value);
                }
            }

            Console.WriteLine("Sucess!");
            Console.WriteLine();
            Console.WriteLine("Collecting Processor Information");

            Dictionary<string, string> processorDictionary =
            new Dictionary<string, string>();

            foreach (string property in processor.GetPropertyValues()) //enumerate the collection
            {
                var keys = property.Split(":");
                var key = keys[0].Trim();
                var value = keys[1].Trim();

                if (key == "CurrentClockSpeed2601")
                {
                    processorDictionary.Add(key, value);
                }

                if (key == "LoadPercentage")
                {
                    processorDictionary.Add(key, value);
                }

                if (key == "Name")
                {
                    processorDictionary.Add(key, value);
                }

                if (key == "Status")
                {
                    processorDictionary.Add(key, value);
                }
            }

            Console.WriteLine("Success!");
            Console.WriteLine();
            Console.WriteLine("Collecting Memory Information");

            Dictionary<string, string> memoryDictionary =
           new Dictionary<string, string>();
            foreach (string property in memory.GetPropertyValues()) //enumerate the collection
            {
                var keys = property.Split(":");
                var key = keys[0].Trim();
                var value = keys[1].Trim();

                if(key == "Status")
                {
                    memoryDictionary.Add(key, value);
                }
            }

            Console.WriteLine();
            Console.WriteLine();
            Console.WriteLine("Collecting Drive Information");

            Dictionary<string, string> driveDictionary =
           new Dictionary<string, string>();
            foreach (string property in drive.GetPropertyValues()) //enumerate the collection
            {
                var keys = property.Split(":");
                var key = keys[0].Trim();
                var value = keys[1].Trim();

                if (key == "Size")
                {
                    driveDictionary.Add(key, value);
                }

                if(key == "Status")
                {
                    driveDictionary.Add(key, value);
                }
            }

            Console.WriteLine("Sucess!");
            Console.WriteLine();
            Console.WriteLine("Collecting Board Information");
            Dictionary<string, string> boardDictionary =
                new Dictionary<string, string>();
            foreach (string property in board.GetPropertyValues()) //enumerate the collection
            {
                var keys = property.Split(":");
                var key = keys[0].Trim();
                var value = keys[1].Trim();

                if (key == "Status")
                {
                    boardDictionary.Add(key, value);
                }

                if (key == "Removable")
                {
                    boardDictionary.Add(key, value);
                }

                if (key == "SerialNumber")
                {
                    boardDictionary.Add(key, value);
                }
            }

            Dictionary<string, Dictionary<string, string>> allDictionary = new Dictionary<string, Dictionary<string, string>>();
            allDictionary.Add("Battery", batteryDictionary);
            allDictionary.Add("Board", boardDictionary);
            allDictionary.Add("Memory", memoryDictionary);
            allDictionary.Add("Drive", driveDictionary);
            allDictionary.Add("Processor", processorDictionary);

            foreach(var dictionary in allDictionary)
            {
                Console.WriteLine(dictionary.Key + "{");
                foreach (var value in dictionary.Value)
                {
                    Console.WriteLine("    " + value.Key + ": " + value.Value);
                }
                Console.WriteLine("} \n");
               
                
            }

            return allDictionary;
        }
    }
}

//SqlConnection connectToSQL()
//{
//    SqlConnectionStringBuilder builder = new SqlConnectionStringBuilder();
//    builder.DataSource = "cpu-sentinel.database.windows.net";
//    builder.UserID = "ibrahimchiha";
//    builder.Password = "password~~Ibrahim97";
//    builder.InitialCatalog = "cpu-sentinel";

//    using (SqlConnection connection = new SqlConnection(builder.ConnectionString))
//    {
//        Console.WriteLine("\nQuery data example:");
//        Console.WriteLine("=========================================\n");

//        StringBuilder sb = new StringBuilder();
//        sb.Append("SELECT TOP 20 pc.Name as CategoryName, p.name as ProductName ");
//        sb.Append("FROM [SalesLT].[ProductCategory] pc ");
//        sb.Append("JOIN [SalesLT].[Product] p ");
//        sb.Append("ON pc.productcategoryid = p.productcategoryid;");
//        String sql = sb.ToString();

//        using (SqlCommand command = new SqlCommand(sql, connection))
//        {
//            connection.Open();
//            using (SqlDataReader reader = command.ExecuteReader())
//            {
//                while (reader.Read())
//                {
//                    Console.WriteLine("{0} {1}", reader.GetString(0), reader.GetString(1));
//                }
//            }
//        }
//    }
//}
//            catch (SqlException e)
//            {
//                Console.WriteLine(e.ToString());
//            }
//            Console.ReadLine();
//        }
//    }
//}
