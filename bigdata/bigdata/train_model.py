from pyspark.sql import SparkSession
from pyspark.ml.feature import VectorAssembler, StringIndexer
from pyspark.ml.classification import DecisionTreeClassifier
from pyspark.ml import Pipeline

# Step 1: Create Spark Session
spark = SparkSession.builder.appName("EduIQModel").getOrCreate()

# Step 2: Load dataset
data = spark.read.csv("students.csv", header=True, inferSchema=True)

# Step 3: Prepare data
indexer = StringIndexer(inputCol="result", outputCol="label")
assembler = VectorAssembler(inputCols=["marks", "attendance"], outputCol="features")
classifier = DecisionTreeClassifier(labelCol="label", featuresCol="features")

pipeline = Pipeline(stages=[indexer, assembler, classifier])
model = pipeline.fit(data)

# Step 4: Save the model
model.save("ml_model")
spark.stop()
